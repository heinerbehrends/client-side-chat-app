<?php
$target_dir = "uploads/";
print_r($_POST["[------WebKitFormBoundaryAFMfTZZBAiHDC6rI
Content-Disposition:_form-data;_name]"]);
$target_file = $target_dir . basename($_REQUEST["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
}
?>
