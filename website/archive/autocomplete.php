<?php 
// Database configuration 
$dbHost     = "canary.simmons.edu"; 
$dbUsername = "bellanti"; 
$dbPassword = "1924917"; 
$dbName     = "lis45801fa19_bellanti_3"; 
 
// Create database connection 
$db = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName)
    or  die('Could not connect: ' . mysql_error()); 
 
// Check connection 
// if ($db->connect_error) { 
//     die("Connection failed: " . $db->connect_error); 
// } 
if ($db->connect_error) { 
    die("Connection failed: " . mysql_error()); 
} 
 
// Get search term 
$searchTerm = $_GET['term']; 
 
// Fetch matched data from the database 
$query = $db->query("SELECT * FROM composer WHERE comp_lname LIKE '%".$searchTerm."%';"); 
 
// Generate array with skills data 
$composer_data = array(); 
if($query->num_rows > 0){ 
    while($row = $query->fetch_assoc()){ 
        $data['id'] = $row['comp_id']; 
        $data['value'] = $row['comp_lname']; 
        array_push($composer_data, $data); 
    } 
} 
 
// Return results as json encoded array 
echo json_encode($composer_data); 
?>