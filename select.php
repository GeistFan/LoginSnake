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
    <link href="/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="/fontawesome/css/brands.css" rel="stylesheet">
    <link href="/fontawesome/css/solid.css" rel="stylesheet">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@600&display=swap');
    </style>
</head>
<body>
	<form class=box>
	<h1>Willkommen bei Snake-Online</h1>
  <!-- <h1>Pfeiltasten-Version</h1> -->
      <br>
    	<a class="button-select" href="easy.php">Einfach</a>
      <br>
      <br>
      <br>
    	<a class="button-select" href="hard.php">Schwer</a>
      <br>
      <br>
      <br>
      <!-- <a class="login" href="select-wasd.php">WASD-Version</a> -->
    	<a class="button-select" href="logout.php">Abmelden</a>
      <!--<button href="logout.php" class="login">Abmelden</button>-->
	</form>
</body>

</html>
