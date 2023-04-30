<?php
  session_start();
  if(!isset($_SESSION['user'])){
    header('Location: /');
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
	<form class=box>
	<h1>Willkommen bei Snake-Online</h1>
  <h1>WASD-Version</h1>
    	<a class="login" href="easy-wasd.php">Einfach</a>
    	<br>
    	<a class="login" href="hard-wasd.php">Schwer</a>
    	<br>
      <a class="login" href="select.php">Pfeiltasten-Version</a>
      <br>
    	<a href="logout.php" class="login">Abmelden</a>
	</form>
</body>

</html>
