<?php require_once("templates/header.php"); ?>


<div class="content">

<h1 class="text-center">Antonín <span class="orange regular">Dvořák</span></h1>
<br>
<h2>Query 3</h2>
<p>Show all Czech composers born within 40 years of Antonín Dvořák</p>
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
CONCAT_WS(' ',comp_fname,comp_mname,comp_lname) AS `Name`,
CONCAT(comp_birthyear,'-',comp_deathyear) AS `Years`,
comp_nationality AS `Nationality`
FROM `composer`
WHERE
comp_nationality = 'Czech' AND
comp_birthyear BETWEEN
    (SELECT comp_birthyear FROM `composer` WHERE comp_lname = 'Dvorak') - 40 AND
(SELECT comp_birthyear FROM `composer` WHERE comp_lname = 'Dvorak') + 40
ORDER BY comp_birthyear;";


$result = mysqli_query($con,$query);

echo "
<table class='results-table'>
<tr>
<th>Name</th>
<th>Years</th>
<th>Nationality</th>
</tr>";


while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['Years'] . "</td>";
  echo "<td>" . $row['Nationality'] . "</td>";
  echo "</tr>";
  };

echo "</table>";

?>
<br><br>
</div><!-- end content -->

<?php require_once("templates/footer.php"); ?>