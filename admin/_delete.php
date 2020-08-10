<?php
$id = $_GET['id'];


$showAlert = false;
$showError = false;

function Delete($id){
  $server = "localhost";
  $username = "root";
  $password = "";
  $database = "test";

  $conn = mysqli_connect($server, $username, $password, $database);
  
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
  // DELETE FROM `notes` WHERE `notes`.`Tid` = 1
  $sql = "DELETE FROM notes WHERE Tid = '$id' LIMIT 1";
  if (mysqli_query($conn, $sql)) {
    header("location: _notes.php");
  $showAlert = "Delete notes Secssesfully";
} else {
  $showError ="ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
}
Delete($id);

?>