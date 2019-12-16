<?php require_once("templates/header.php"); ?>


<div class="content">

<h1 class="text-center">Antonín <span class="orange regular">Dvořák</span></h1>
<br>
<h2>Query 2</h2>
<p>Show the number of Dvořák's works written in each key</p>
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
K.key_name AS `Key signature`,
  COUNT(*) AS `Number of works`
FROM `work` AS W
JOIN `work_key` AS WK ON W.work_id = WK.work_id
JOIN `key` AS K ON WK.key_id = K.key_id
WHERE W.comp_id = (SELECT C.comp_id FROM `composer` AS C WHERE comp_lname = 'Dvorak')
GROUP BY K.key_name;";


$result = mysqli_query($con,$query);

echo "
<table class='results-table'>
<tr>
<th>Key Signature</th>
<th>Number of Works</th>
</tr>";


while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['Key signature'] . "</td>";
  echo "<td>" . $row['Number of works'] . "</td>";
  echo "</tr>";
  };

echo "</table>";

?>
<br><br>
</div><!-- end content -->

<?php require_once("templates/footer.php"); ?>