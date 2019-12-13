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
  wv_id,
  wv_title,
  wv_composer,
  wv_completed,
  wv_era,
  wv_keys,
  wv_times,
  wv_tempos,
  wv_instruments,
  wv_wiki,
  wv_imslp
FROM
  work_view AS wv ";

// add to query string based on user inputs
// if ($input) {
//   $query = $query."WHERE concat(comp_fname,' ',comp_mname,' ',comp_lname) LIKE '%{$input}%' ";
// }
$query = ($input) ? $query."WHERE wv_title LIKE '%{$input}%';" :$query;

// add sortby and close query
// $query = $query."GROUP BY C.comp_id ORDER BY comp_birthyear;";


$result = mysqli_query($con,$query);

echo "<table class='results-table'>
<tr>
<th>Title</th>
<th>Composer</th>
<th>Year</th>
<th>Era</th>
<th>Key/s</th>
<th>Time/s</th>
<th>Tempo/s</th>
<th>Instruments</th>
<th>Wiki</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='" . $row['wv_id'] . "'>" . $row['wv_title'] . "</a></td>";
  echo "<td>" . $row['wv_composer'] . "</td>";
  echo "<td>" . $row['wv_completed'] . "</td>";
  echo "<td>" . $row['wv_era'] . "</td>";
  echo "<td>" . $row['wv_keys'] . "</td>";
  echo "<td>" . $row['wv_times'] . "</td>";
  echo "<td>" . $row['wv_tempos'] . "</td>";
  echo "<td>" . $row['wv_instruments'] . "</td>";
  echo "<td><a href='" . $row['wv_wiki'] . "'>Go</td>";
  echo "</tr>";
  }
echo "</table>";

?>


</div><!-- end content -->

<?php require_once("templates/footer.php"); ?>