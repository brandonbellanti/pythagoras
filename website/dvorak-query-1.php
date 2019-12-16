<?php require_once("templates/header.php"); ?>


<div class="content">

<h1 class="text-center">Antonín <span class="orange regular">Dvořák</span></h1>
<br>
<h2>Query 1</h2>
<p>Show all Czech composers</p>
<br>

<?php

$host='canary.simmons.edu';
$user='bellanti';
$password='1924917';
$database="lis45801fa19_bellanti_3";

$con = mysqli_connect($host,$user,$password,$database)
   or  die('Could not connect: ' . mysql_error());

$con->set_charset("utf8");


$query = "SELECT
CONCAT(comp_lname,', ',comp_fname, ' ',comp_mname) AS `Name`,
  comp_nationality AS `Nationality`
FROM composer
WHERE comp_nationality = 'Czech'
ORDER BY comp_lname;";


$result = mysqli_query($con,$query);

echo "
<table class='results-table'>
<tr>
<th>Name</th>
<th>Nationality</th>
</tr>";


while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['Nationality'] . "</td>";
  echo "</tr>";
  };

echo "</table>";

?>
<br><br>
</div><!-- end content -->

<?php require_once("templates/footer.php"); ?>