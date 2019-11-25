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

// create variables from form inputs
$name = $_POST['comp_name'];
$afteryear = $_POST['comp_bornafter'];
$beforeyear = $_POST['comp_bornbefore'];
$nationality = $_POST['comp_nationality'];


// give user feedback for entered search terms
// if ($input) {echo "Your search input: \"{$input}\"<br>";}


// replace spaces in title with '%' for SQL LIKE statements
$name = str_replace(' ','%',$name);

echo "<br>";

// start query string
$query = "SELECT concat(comp_fname,' ',comp_mname,' ',comp_lname) AS 'name', concat(comp_birthdate,'-',comp_deathdate) AS 'years', comp_nationality AS 'nationality' FROM composer WHERE 1=1 ";

// add to query string based on user inputs
$query = ($name) ? $query."AND concat(comp_fname,' ',comp_mname,' ',comp_lname) LIKE '%{$name}%' " :$query;

$query = ($afteryear) ? $query."AND comp_birthdate > {$afteryear} " :$query;
$query = ($beforeyear) ? $query."AND comp_birthdate < {$beforeyear} " :$query;
$query = ($nationality) ? $query."AND comp_nationality LIKE '%{$nationality}%' " :$query;

// add sortby and close query
$query = $query."ORDER BY comp_birthdate;";


$result = mysqli_query($con,$query);

echo "<table class='results-table'>
<tr>
<th>Name</th>
<th>Years</th>
<th>Nationality</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['years'] . "</td>";
  echo "<td>" . $row['nationality'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

?>


</div><!-- end content -->

<?php require_once("templates/footer.php"); ?>