<?php require_once("templates/header.php"); ?>


<div class="content">

<h1 class="text-center">search the <span class="orange regular">database</span></h1>
<br>


<h2>Search results</h2>
<?php
$host='canary.simmons.edu';
$user='bellanti';
$password='1924917';
$database="lis45801fa19_bellanti_3";

$con = mysqli_connect($host,$user,$password,$database)
   or  die('Could not connect: ' . mysql_error());

$con->set_charset("utf8");

// create variables from form inputs
$input = $_POST['composer_work'];


// give user feedback for entered search terms
if ($input) {echo "Your search input: \"{$input}\"<br>";}


// replace spaces in title with '%' for SQL LIKE statements
$input = str_replace(' ','%',$input);

echo "<br>";

// start query string
$query = "SELECT
  concat(comp_fname,' ',comp_mname,' ',comp_lname) AS 'name',
  concat(comp_birthdate,'-',comp_deathdate) AS 'years',
  comp_nationality AS 'nationality',
  era_name AS 'era'
FROM
  (composer AS C JOIN composer_era AS CE ON C.comp_id = CE.comp_id)
JOIN era AS E ON CE.era_id = E.era_id ";

// add to query string based on user inputs
// if ($input) {
//   $query = $query."WHERE concat(comp_fname,' ',comp_mname,' ',comp_lname) LIKE '%{$input}%' ";
// }
$query = ($input) ? $query."WHERE concat(comp_fname,' ',comp_mname,' ',comp_lname) LIKE '%{$input}%' " :$query;

// add sortby and close query
$query = $query."ORDER BY comp_birthdate;";


$result = mysqli_query($con,$query);

echo "<table class='results-table'>
<tr>
<th>Name</th>
<th>Years</th>
<th>Nationality</th>
<th>Era</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['years'] . "</td>";
  echo "<td>" . $row['nationality'] . "</td>";
  echo "<td>" . $row['era'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

?>


</div><!-- end content -->

<?php require_once("templates/footer.php"); ?>