<?php

$score_exists = isset($_POST['score']);

require_once "config.php";

if ($score_exists == true)
{
    $sql ="UPDATE users SET highscore = $score_exists WHERE id=1";
    $stmt = $link->prepare($sql);

    if ($stmt === false)
        die('MySQL Fehler: ' . $link->error);

    $stmt->bind_param('i', $_POST['score']);
    $stmt->execute();

    echo 'Die Score ist ' . $_POST['score'];
}
else
    echo 'Keine Score oder Name angegeben!';

?>
<html>
<head>
     <title>Test Formular</title>
</head>
<body>
    <form action='highscore.php' method='POST'>
        Score: <input type='text' name='score'>
        <input type='submit'>
    </form>
</body>
</html>
UPDATE users SET highscore = $$score_exists WHERE id=1