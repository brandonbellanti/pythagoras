<?php require_once("templates/header.php"); ?>


<div class="content">

<h1 class="text-center">search <span class="orange regular">results</span></h1>
<br>


<!-- <h2>Search results</h2> -->
<?php

// get the page uri -- "/adv-search-results.php?comp=38&work=91"
$uri = $_SERVER['REQUEST_URI'];

// split the uri and take the parameters after the filepath -- "comp=38&work=91"
$params = explode('?',$uri)[1];

// match for both composer id and work id -- "comp=38" and "work=91"
preg_match('/(comp=\d+)/', $params, $comp_id);
preg_match('/(work=\d+)/', $params, $work_id);

// split matches on '=' to get just the number and convert to int -- `38` and `91`
$comp_id = (int)explode('=',$comp_id[0])[1];
$work_id = (int)explode('=',$work_id[0])[1];

$host='canary.simmons.edu';
$user='bellanti';
$password='1924917';
$database="lis45801fa19_bellanti_3";

$con = mysqli_connect($host,$user,$password,$database)
   or  die('Could not connect: ' . mysql_error());

$con->set_charset("utf8");

$terms = FALSE;


// create variables from form inputs
$name = $_POST['comp_name'];
$afteryear = $_POST['comp_bornafter'];
$beforeyear = $_POST['comp_bornbefore'];
$nationality = $_POST['comp_nationality'];
$era = $_POST['comp_era'];



if ($comp_id||$name||$afteryear||$beforeyear||$work_composer||$nationality||$era)
{
  $terms = TRUE;


  // replace spaces in title with '%' for SQL LIKE statements
  $name = str_replace(' ','%',$name);

  echo "<br>";

  // start query string
  $comp_query = "SELECT
    `cv`.cv_id,
    cv_name,
    cv_born,
    cv_died,
    cv_nationality,
    cv_era,
    cv_wiki
  FROM composer_view AS cv
  WHERE 1=1 ";

  // add to query string based on user inputs
  $comp_query = ($comp_id) ? $comp_query."AND `cv`.cv_id = {$comp_id} " :$comp_query;
  $comp_query = ($name) ? $comp_query."AND cv_name LIKE '%{$name}%' " :$comp_query;
  $comp_query = ($afteryear) ? $comp_query."AND cv_born > {$afteryear} " :$comp_query;
  $comp_query = ($beforeyear) ? $comp_query."AND cv_born < {$beforeyear} " :$comp_query;
  $comp_query = ($nationality) ? $comp_query."AND cv_nationality LIKE '%{$nationality}%' " :$comp_query;
  $comp_query = ($era) ? $comp_query."AND cv_era LIKE '%{$era}%' " :$comp_query;

  $comp_query = $comp_query."ORDER BY cv_surname;";


  $comp_result = mysqli_query($con,$comp_query);

  echo "
  <h2>composers</h2><br>
  <table class='results-table'>
  <tr>
  <th>Name</th>
  <th>Born</th>
  <th>Died</th>
  <th>Nationality</th>
  <th>Era/s</th>
  <th>Wiki</th>
  </tr>";

  if (mysqli_num_rows($comp_result) == 0) {
    echo "</table>";
    echo "Sorry, no composers found!";
  }
  else {
    while($row = mysqli_fetch_array($comp_result))
      {
      $comp_link = "adv-search-results.php?comp=" . $row['cv_id'];
      echo "<tr>";
      echo "<td><a href='{$comp_link}'>" . $row['cv_name'] . "</a></td>";
      // echo "<td>" . $row['cv_name'] . "</td>";
      echo "<td>" . $row['cv_born'] . "</td>";
      echo "<td>" . $row['cv_died'] . "</td>";
      echo "<td>" . $row['cv_nationality'] . "</td>";
      echo "<td>" . $row['cv_era'] . "</td>";
      // echo "<td>" . $row['cv_wiki'] . "</td>";
      $compwikirow = ($row['cv_wiki']) ? "<td><a href='" . $row['cv_wiki'] . "'>View</td>" :"<td></td>";
      echo $compwikirow;

      echo "</tr>";
      }
    echo "</table>";
  };
  echo '<br><br>';
};























$work_title = $_POST['work_title'];
$work_identifier = $_POST['work_identifier'];
$work_composer = $_POST['work_composer'];
$work_afteryear = $_POST['work_afteryear'];
$work_beforeyear = $_POST['work_beforeyear'];
$work_era = $_POST['work_era'];
$work_keys = $_POST['work_key'];
$work_times = $_POST['work_time'];
$work_tempos = $_POST['work_tempo'];
$work_instruments = $_POST['work_instrument'];

if ($comp_id||$work_id||$work_title||$work_identifier||$work_composer||$work_afteryear||$work_beforeyear||$work_era||$work_keys||$work_times||$work_tempos||$work_instruments)
{
  $terms = TRUE;


  // give user feedback for entered search terms
  // if ($input) {echo "Your search input: \"{$input}\"<br>";}


  // replace spaces in title with '%' for SQL LIKE statements
  $work_title = str_replace(' ','%',$work_title);

  echo "<br>";

  $work_query = "SELECT
    wv_id,
    cv_id,
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
    work_view AS wv
  WHERE 1=1 ";

  // add to query string based on user inputs
  // if ($input) {
  //   $query = $query."WHERE concat(comp_fname,' ',comp_mname,' ',comp_lname) LIKE '%{$input}%' ";
  // }
  $work_query = ($comp_id) ? $work_query."AND cv_id = {$comp_id} " :$work_query;
  $work_query = ($work_id) ? $work_query."AND wv_id = {$work_id} " :$work_query;
  $work_query = ($work_title) ? $work_query."AND wv_title LIKE '%{$work_title}%' " :$work_query;
  $work_query = ($work_identifier) ? $work_query."AND wv_identifier LIKE '%{$work_identifier}%' " :$work_query;
  $work_query = ($work_composer) ? $work_query."AND wv_composer LIKE '%{$work_composer}%' " :$work_query;
  $work_query = ($work_beforeyear) ? $work_query."AND wv_completed < {$work_beforeyear} " :$work_query;
  $work_query = ($work_afteryear) ? $work_query."AND wv_completed > {$work_afteryear} " :$work_query;
  $work_query = ($work_era) ? $work_query."AND wv_era LIKE '%{$work_era}%' " :$work_query;
  $work_query = ($work_keys) ? $work_query."AND wv_keys LIKE '%{$work_keys}%' " :$work_query;
  $work_query = ($work_times) ? $work_query."AND wv_times LIKE '%{$work_times}%' " :$work_query;
  $work_query = ($work_tempos) ? $work_query."AND wv_tempos LIKE '%{$work_tempos}%' " :$work_query;
  $work_query = ($work_instruments) ? $work_query."AND wv_instruments LIKE '%{$work_instruments}%' " :$work_query;

  // add sortby and close query
  // $query = $query."GROUP BY C.comp_id ORDER BY comp_birthyear;";
  $query = $query.";";


  $work_result = mysqli_query($con,$work_query);


  echo "
  <h2>works</h2>
  <br>
  <div class='table-wrapper'>
  <table class='results-table'>
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

  if (mysqli_num_rows($work_result) == 0) {
    echo "</table>";
    echo "Sorry, no works found!<br><br>";
  }
  else {
    while($row = mysqli_fetch_array($work_result))
      {
      // $work_link = "composer-search.php?comp=" . $row['cv_id'];
      echo "<tr>";
      echo "<td><a href='" . $row['wv_id'] . ".php'>" . $row['wv_title'] . "</a></td>";
      echo "<td>" . $row['wv_composer'] . "</td>";
      echo "<td>" . $row['wv_completed'] . "</td>";
      echo "<td>" . $row['wv_era'] . "</td>";
      echo "<td>" . $row['wv_keys'] . "</td>";
      echo "<td>" . $row['wv_times'] . "</td>";
      echo "<td>" . $row['wv_tempos'] . "</td>";
      echo "<td>" . $row['wv_instruments'] . "</td>";
      $wikirow = ($row['wv_wiki']) ? "<td><a href='" . $row['wv_wiki'] . "'>View</td>" :"<td></td>";
      // echo "<td><a href='" . $row['wv_wiki'] . "'>View</td>";
      echo $wikirow;
      echo "</tr>";
      }
    echo "</table></div><br><br>";
  };


};

if ($terms == FALSE) {echo "No search terms entered!<br><br><br>";};






?>
<br>
<div id="newsearch" class="text-center scale"><a href="search.php"><span class="button">new search</span></a></div>
<br>
<br>
</div><!-- end content -->

<?php require_once("templates/footer.php"); ?>