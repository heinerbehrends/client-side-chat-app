<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gorillachat";

// declare result array
$result_array = array();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

// sql to get data from db
$sql = "SELECT * FROM messages ORDER BY id DESC LIMIT 10";
$result = $conn->query($sql);
// print_r($result) ;
// if there are results push them to the result_array
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    array_push($result_array, $row);
  }
}
header('Content-Type: application/json');
// echo a json encoded array to the client
echo json_encode($result_array);
// close the db connection
$conn->close();
?>
