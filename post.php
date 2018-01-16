<?php
// define variables and set to empty values
$first_name = $email = $last_name = "";
// input validation with test_input() not working
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $first_name = test_input($_POST["first_name"]);
  $last_name = test_input($_POST["last_name"]);
  $email = test_input($_POST["email"]);
  // setup variables for db access
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "chat";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }






  ?>
