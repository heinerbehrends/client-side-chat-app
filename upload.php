<?php
$target_dir = "uploads/";
$file_name = basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $file_name;

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  $file_upload_array = [
    'fileName' => $file_name,
    'link' => $target_file
  ];

  echo json_encode($file_upload_array, JSON_UNESCAPED_SLASHES);
}
?>
