<?php
$target_dir = "uploads/";
$file_name = basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $file_name;

$_POST["userName"];

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  $file_upload_array = [
    'fileName' => $file_name,
    'link' => $target_file
  ];

  echo json_encode($file_upload_array, JSON_UNESCAPED_SLASHES);

  include 'config.php';

  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
  }
  // Prepare and bind
  $stmt = $conn->prepare("INSERT INTO messages (mykey, value) VALUES (?, ?)");
  $stmt->bind_param("ss",$mykey, $message);

  // Escape user inputs for security
  $message = "<a href='" . $target_file . "'>" . $file_name . "</a>";
  $mykey = $conn->real_escape_string($_POST["userName"]);
  // $message_array = [
  //   'message' => $message,
  //   'user' => $mykey,
  // ];
  // execute prepared statement
  $stmt->execute();
  // close the db connection
  $stmt->close();
  $conn->close();

}
?>
