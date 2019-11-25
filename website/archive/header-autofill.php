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
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,300i,400,400i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script>
    $(function() {
        $("#composer_work").autocomplete({
            source: "autofill.php",
            select: function( event, ui ) {
                event.preventDefault();
                $("#composer_work").val(ui.item.id);
            }
        });
    });
    </script>
</head>
<body>
<div class="topnav" id="myTopnav">
  <div class="topnav-left">
    <a href="index.php"><span class="orange regular large">pythagoras</span></a>
  </div><!-- end topnav-left -->
  <div class="topnav-right">
    <a href="index.php">home</a>
    <a href="search.php">search</a>
    <a href="about.php">about</a>
    <a href="help.php">help</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
      <i class="fa fa-bars"></i>
    </a>
  </div><!-- end topnav-right -->
</div><!-- end topnav -->