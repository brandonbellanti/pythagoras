<?php require_once("templates/header.php"); ?>


<div class="content">

<h1 class="text-center">Antonín <span class="orange regular">Dvořák</span></h1>
<br>
<h2>Query 4</h2>
<p>Show the tempos of all third movements in Dvořák's works</p>
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
CONCAT(work_title,', ',work_mvtitle) AS Title,
  work_mvnumber AS `Movement number`,
CONCAT_WS(' ',comp_fname,comp_mname,comp_lname) AS Composer,
  GROUP_CONCAT(T.tempo_marking SEPARATOR ', ') AS Tempo
FROM `work` AS W
LEFT JOIN `composer` AS C ON W.comp_id = C.comp_id
LEFT JOIN `work_tempo` AS WT on W.work_id = WT.work_id
LEFT JOIN `tempo` AS T on WT.tempo_id = T.tempo_id
WHERE C.comp_lname = 'Dvorak' AND W.work_mvnumber = 3
GROUP BY W.work_id
ORDER BY W.work_id;";


$result = mysqli_query($con,$query);

echo "
<table class='results-table'>
<tr>
<th>Title</th>
<th>Movement Number</th>
<th>Composer</th>
<th>Tempo</th>
</tr>";


while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['Title'] . "</td>";
  echo "<td>" . $row['Movement number'] . "</td>";
  echo "<td>" . $row['Composer'] . "</td>";
  echo "<td>" . $row['Tempo'] . "</td>";
  echo "</tr>";
  };

echo "</table>";

?>
<br><br>
</div><!-- end content -->

<?php require_once("templates/footer.php"); ?>