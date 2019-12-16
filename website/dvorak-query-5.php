<?php require_once("templates/header.php"); ?>


<div class="content">

<h1 class="text-center">Antonín <span class="orange regular">Dvořák</span></h1>
<br>
<h2>Query 5</h2>
<p>Show all Dvořák's works completed while Brahms was writing his Hungarian Dances</p>
<br>

<?php

$host='canary.simmons.edu';
$user='bellanti';
$password='1924917';
$database="lis45801fa19_bellanti_3";

$con = mysqli_connect($host,$user,$password,$database)
   or  die('Could not connect: ' . mysql_error());

$con->set_charset("utf8");


$query = "SELECT W.work_title AS Title, W.work_yearcompleted AS `Year Completed`
FROM `work` AS W
JOIN `composer` AS C ON W.comp_id = C.comp_id
WHERE
	W.comp_id = (SELECT comp_id FROM `composer` WHERE comp_lname = 'Dvorak') AND
    W.work_yearcompleted BETWEEN
		(SELECT MIN(work_yearbegun)
        FROM `work` AS W JOIN `composer` AS C ON W.comp_id = C.comp_id
        WHERE comp_lname = 'Brahms') AND
		(SELECT MAX(work_yearcompleted)
        FROM `work` AS W JOIN `composer` AS C ON W.comp_id = C.comp_id
        WHERE comp_lname = 'Brahms')
GROUP BY work_title
ORDER BY W.work_yearcompleted
;";


$result = mysqli_query($con,$query);

echo "
<table class='results-table'>
<tr>
<th>Title</th>
<th>Year Completed</th>
</tr>";


while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['Title'] . "</td>";
  echo "<td>" . $row['Year Completed'] . "</td>";
  echo "</tr>";
  };

echo "</table>";

?>
<br><br>
</div><!-- end content -->

<?php require_once("templates/footer.php"); ?>