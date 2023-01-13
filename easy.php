<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
$highscore = isset($_POST["highscore"]);
$score_exists = isset($_POST["highscore"]);

require_once "config.php";

if ($score_exists == true)
{
    $sql ="UPDATE users SET highscore = $highscore WHERE id=1";
    $stmt = $link->prepare($sql);

    if ($stmt === false)
        die('MySQL Fehler: ' . $link->error);

    $stmt->bind_param('i', $_POST["highscore"]);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snake</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <br>
    <a class="link" href="logout.php">Abmelden</a> <a class="link" href="select.php">Zurück</a>

    <canvas class="box-game" id="canvas" width="800" height="800"></canvas>

    <script>
        let canvas = document.getElementById('canvas');
        let ctx = canvas.getContext('2d');
        let rows = 20;
        let cols = 20;
        let snake = [
            {x: 2, y: 3}
        ];
        let cellWidth = canvas.width / cols;
        let cellHeight = canvas.height / rows;
        let direction = '';
        let foodCollected = false;
        var score = 0;
        var highscore = 0;
        //var highscore = <?php echo json_encode($highscore); ?>;

        setInterval(gameLoop, 135); // die funktion gameLoop alle 200 Millisekunden ausführen
        document.addEventListener('keydown', keyDown); // wenn taste gedrückt wird, event starten

        placeFood(); // Food plazieren
        draw(); // Canvas färben

        function draw()
        {
            ctx.fillStyle = 'black'; // Farbe schwarz auswählen
            ctx.fillRect(0, 0, canvas.width, canvas.height); // Ganze leinwand füllen


            ctx.fillStyle = 'white'; // weiß auswählen
            add(130, 170); // füllen
            add(160, 170); // fühlen
            snake.forEach(part => add(part.x, part.y)); // die snake bewegen

            ctx.fillStyle = 'yellow'; // gelb auswählen
            add(food.x, food.y); // food färben
            drawScore(); // Score zeigen
            drawHighScore(); // Score zeigen

            requestAnimationFrame(draw); // draw die ganze zeit ausführen
        }
        function drawScore() {
            ctx.font = "16px Arial";
            ctx.fillStyle = "#0095DD";
            ctx.fillText("Score: "+score, 8, 20);
        }
        function drawHighScore() {
            ctx.font = "16px Arial";
            ctx.fillStyle = "#0095DD";
            ctx.fillText("Highscore: "+highscore, 100, 20);
        }
        function placeFood() // Food plazieren
        {
            let randomX = Math.floor(Math.random() * cols); // Zufällige Variable 'X' errechnen
            let randomY = Math.floor(Math.random() * rows); // Zufällige Variable 'Y' errechnen

            food = {
                x: randomX,
                y: randomY
            } // 'X' & 'Y' zusammen rechnen und bereich food bestimmen
        }
        function testGameOver()
        {
            let firstPart = snake[0];
            let otherParts = snake.slice(1);
            let duplicatePart = otherParts.find(part => part.x == firstPart.x && part.y == firstPart.y);
            if (snake[0].x < 0)
            {
                snake[0].x = 19;
            }
            if (snake[0].x > cols - 1)
            {
                snake[0].x = 0;
            }
            if (snake[0].y < 0)
            {
                snake[0].y = 19;
            }
            if (snake[0].y > cols - 1)
            {
                snake[0].y = 0;
            }
            if (duplicatePart)
            {
                placeFood();
                snake = [{
                    x: 19,
                    y: 3
                }]
                direction = '';
                score = 0;
            }
        }

        function add(x, y)
        {
            ctx.fillRect(x * cellWidth, y * cellHeight, cellWidth - 3, cellHeight - 3);
        }
        function shiftSnake()
        {
            for (let i = snake.length - 1; i > 0; i--) {
                const part = snake[i];
                const lastpart = snake[i - 1];
                part.x = lastpart.x;
                part.y = lastpart.y;

            }
        }
        function gameLoop() // Tasten ausführen
        {
            testGameOver();
            if(foodCollected)
            {
                score = score +1;
                snake = [{x: snake[0].x, y: snake[0].y}, ...snake];
                foodCollected = false;
            }
            if(score > highscore)
            {
                highscore = score;
            }
            shiftSnake();
            if(direction == 'LEFT')
            {
                snake[0].x--;
            }
            if(direction == 'RIGHT')
            {
                snake[0].x++;
            }
            if(direction == 'UP')
            {
                snake[0].y--;
            }
            if(direction == 'DOWN')
            {
                snake[0].y++;
            }
            if(snake[0].x == food.x &&  snake[0].y == food.y)
            {
                foodCollected = true;
                placeFood(); // Food neu Plazieren
            }
        }
        function keyDown(e) // Tasten bestimmen
        {
            if(e.keyCode == 37)
            {
                direction = 'LEFT';
            }
            if(e.keyCode == 38)
            {
                direction = 'UP';
            }
            if(e.keyCode == 39)
            {
                direction = 'RIGHT';
            }
            if(e.keyCode == 40)
            {
                direction = 'DOWN';
            }
        }
    </script>
    <h1><center>Drücke die Pfeiltasten um das Spiel zu beginnen!</center></h1>
</body>
</html>