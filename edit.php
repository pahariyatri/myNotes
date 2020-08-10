<?php
$id = $_GET['id'];
session_start();

function update($id){

  include 'include/conn.php';

  $sql = "SELECT * FROM notes WHERE Tid ='$id'";
  
  $records = $conn->query($sql);

  foreach ($records as $data) {
   
    $Tname = $data['Tname'];
    $Tdesc= $data['Tdesc'];
 
  }

  if (isset($_POST['update'])) {

    if(empty($_POST['Tname'])){
      $Tname = $Tname;
      
    }
    else{
      $Tname = $_POST['Tname'];
    }

    if(empty($_POST['Tdesc'])){
      $Tdesc = $Tdesc;
      
    }
    else{
      $Tdesc = $_POST['Tdesc'];
    }
    // UPDATE `notes` SET `Tname`= 'Bootstrap',`Tdesc` = 'fklaj' WHERE `notes`.`Tid` = 9
    $sql = "UPDATE notes SET Tname = '$Tname', Tdesc =  '$Tdesc', dt=now() WHERE Tid = '$id'";
    
    if (mysqli_query($conn, $sql)) {
      header("location: user_notes.php");
    // echo "Record updated successfully";
  } else {
    $showError ="ERROR: Could not able to execute $sql. " . mysqli_error($conn);
  }

}


}
 update($id);


  // if(mysqli_query($conn, $sql)){
      
        
  //    $showAlert = true;
  //    header("location: details.php?id=$id");
  //  } else{
  //    $showError ="ERROR: Could not able to execute $sql. " . mysqli_error($conn);
  //  } 
?> 
