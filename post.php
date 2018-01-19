<?php
// setup variables for db access
include 'config.php';

// define variables and set to empty values
$message = "";

// input validation with test_input() not working
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $message = $_POST["message"];

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Escape user inputs for security
    $message = $conn->real_escape_string($_REQUEST['message']);
    $mykey = $conn->real_escape_string($_REQUEST['mykey']);
    $message_array = [
      'message' => $message,
      'user' => $mykey,
    ];
    // attempt insert query execution
    $sql = "INSERT INTO messages (mykey, value) VALUES ('$mykey', '$message')";
    // $sql2 = "SELECT row from table ORDER BY id DESC LIMIT 1";

      // $last_row = $conn->query($sql2);
    if($conn->query($sql) == true) {
      echo json_encode($message_array);
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
