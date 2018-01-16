<?php
// define variables and set to empty values
$message = "";
$mykey = "heiner";
// input validation with test_input() not working
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // $user_name = test_input($_POST["user_name"]);

  $message = $_POST["message"];
  // setup variables for db access
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "gorillachat";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Escape user inputs for security
    $message = $conn->real_escape_string($_REQUEST['message']);

    // attempt insert query execution
    $sql = "INSERT INTO messages (value, mykey) VALUES ('$message', '$mykey')";
    $sql2 = "SELECT row from table ORDER BY id DESC LIMIT 1";

    $last_row = $conn->query($sql2);
    if($conn->query($sql) == true) {
      echo $last_row;
    }
    // $last_row = $conn->query($sql2);
    else {
      echo "ERROR: Could not able to execute $sql. " . $conn->error;
    }

    // Close connection
    $conn->close();
  }


  // input validation
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>
