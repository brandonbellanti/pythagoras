<?php
  $directoryURI = $_SERVER['REQUEST_URI'];
  $path = parse_url($directoryURI, PHP_URL_PATH);
  $components = explode('/', $path);
  $page = end($components);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pythagoras</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i&display=swap" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,300i,500,500i,700,700i&display=swap" rel="stylesheet">
    <script src="js/main.js"></script>
</head>
<body>
<div class="topnav" id="myTopnav">
  <div class="topnav-left">
    <a href="index.php"><span class="orange regular large">pythagoras</span></a>
  </div><!-- end topnav-left -->
  <div class="topnav-right">
    <a href="index.php" class="<?php if ($page=="index.php") {echo "active"; }?>">home</a>
    <a href="search.php" class="<?php if ($page=="search.php") {echo "active"; }?>">search</a>
    <a href="about.php" class="<?php if ($page=="about.php") {echo "active"; }?>">about</a>
    <a href="help.php" class="<?php if ($page=="help.php") {echo "active"; }?>">help</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
      <i class="fa fa-bars"></i>
    </a>
  </div><!-- end topnav-right -->
</div><!-- end topnav -->