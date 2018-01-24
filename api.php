<?php
// use config.php for server name, user name, password and database name
include 'config.php';

// declare result array
$result_array = array();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  // sql to get data from db
  $sql = "SELECT * FROM messages ORDER BY id ASC";
  $result = $conn->query($sql);
  // if there are results push them to the result_array
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      array_push($result_array, $row);
    }
  }
  header('Content-Type: application/json');
  // echo a json encoded array to the client
  echo json_encode($result_array);
}

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
  $message = "";
  parse_str(file_get_contents("php://input"), $_PUT);

  // Prepare and bind
  $stmt = $conn->prepare("INSERT INTO messages (mykey, value) VALUES (?, ?)");
  $stmt->bind_param("ss",$mykey, $message);

  // Escape user inputs for security
  $message = $conn->real_escape_string($_PUT['message']);
  $mykey = $conn->real_escape_string($_PUT['mykey']);
  $message_array = [
    'message' => $message,
    'user' => $mykey,
  ];
  // execute prepared statement
  $stmt->execute();
  // add header and echo json array
  header('Content-Type: application/json');
  echo json_encode($message_array);
}

// close the db connection
$conn->close();
 ?>
