<?php
$id = $_GET['id'];
session_start();

$showAlert = false;
$showError = false;

function Delete($id){
  include 'include/conn.php';
  // DELETE FROM `notes` WHERE `notes`.`Tid` = 1
  $sql = "DELETE FROM notes WHERE Tid = '$id' LIMIT 1";
  if (mysqli_query($conn, $sql)) {
    header("location: user_notes.php");
  $showAlert = "Delete notes Secssesfully";
} else {
  $showError ="ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
}
Delete($id);



//   include 'include/conn.php';
//   // DELETE FROM `notes` WHERE `notes`.`Tid` = 1
//   $sql = "DELETE FROM notes WHERE Tid = '$id' LIMIT 1";
// //   echo "$sql";
// //   if (mysqli_query($conn, $sql)) {
// //   echo "Record deleted successfully";
// // } else {
// //   echo "Error deleting record: " . mysqli_error($conn);
// // }
//   if (mysqli_query($conn, $sql)) {
//     header("location: user_notes.php");
//   $showAlert = true;
// } else {
//   $showError ="ERROR: Could not able to execute $sql. " . mysqli_error($conn);
// }


?>