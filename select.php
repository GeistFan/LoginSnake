<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
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
  <!-- <h1>Pfeiltasten-Version</h1> -->
    	<a class="login" href="easy.php">Einfach</a>
    	<a class="login" href="hard.php">Schwer</a>
      <!-- <a class="login" href="select-wasd.php">WASD-Version</a> -->
    	<a href="logout.php" class="login">Abmelden</a>
	</form>
</body>

</html>
