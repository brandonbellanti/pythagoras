
<?php

// get the page uri
$ui = $_SERVER['REQUEST_URI'];

// split the uri and take the parameters after the filepath
$params = explode('?',$uri)[1];

// match for both composer id and work id
preg_match('/(comp=\d+)/', $params, $comp_id);
preg_match('/(work=\d+)/', $params, $work_id);

// split matches on '=' to get just the number and convert to int
$comp_id = (int)explode('=',$comp_id[0])[1];
$work_id = (int)explode('=',$work_id[0])[1];


$host='canary.simmons.edu';
$user='bellanti';
$password='1924917';
$database="lis45801fa19_bellanti_3";

$con = mysqli_connect($host,$user,$password,$database)
   or  die('Could not connect: ' . mysql_error());

$con->set_charset("utf8");

$query = "SELECT
  wv_id,
  wv_title,
  wv_composer,
  cv_id,
  wv_completed,
  wv_era,
  wv_keys,
  wv_times,
  wv_tempos,
  wv_instruments,
  wv_wiki,
  wv_imslp
FROM
  work_view AS wv
WHERE 1=1 ";

// add to query string based on user inputs
// if ($input) {
//   $query = $query."WHERE concat(comp_fname,' ',comp_mname,' ',comp_lname) LIKE '%{$input}%' ";
// }
$query = ($work_id) ? $query."AND wv_id = {$work_id} " :$query;
$query = ($comp_id) ? $query."AND cv_id = {$comp_id} " :$query;

// add sortby and close query
$query = $query."ORDER BY wv_composer;";


$result = mysqli_query($con,$query);

if (mysqli_num_rows($result) == 0)
    {echo "Sorry, no results found!";}
else
    {
    echo "It's not empty!";
    echo "<table class='results-table'>
    <tr>
    <th>Title</th>
    <th>Composer</th>
    <th>Year</th>
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
    echo "<td>" . $row['wv_keys'] . "</td>";
    echo "<td>" . $row['wv_times'] . "</td>";
    echo "<td>" . $row['wv_tempos'] . "</td>";
    echo "<td>" . $row['wv_instruments'] . "</td>";
    echo "<td><a href='" . $row['wv_wiki'] . "'>Go</td>";
    echo "</tr>";
    }
    echo "</table>";
    };

?>

