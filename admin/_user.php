   <?php
  
    
          
          if(isset($_GET['id'])) {
    //do something
            $id = $_GET['id'];
            var_dump($id);
          delete($id);
}
         
       
        
      
        function delete($id) { 
            $server = "localhost";
            $username = "root";
            $password = "";
            $database = "test";

            $conn = mysqli_connect($server, $username, $password, $database);
            
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            // DELETE FROM `user` WHERE `user`.`id` = 1"
            $sql = "DELETE FROM user WHERE id = '$id' LIMIT 1";
            if (mysqli_query($conn, $sql)) {
               header("location: _user.php");
            $showAlert = "Delete notes Secssesfully";
          } else {
            $showError ="ERROR: Could not able to execute $sql. " . mysqli_error($conn);
          }

        } 
        
        
    ?> 
<?php 

  $server = "localhost";
  $username = "root";
  $password = "";
  $database = "test";

  $conn = mysqli_connect($server, $username, $password, $database);
  
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
 $sql = "SELECT * FROM user";
$result = $conn->query($sql);
include ('_nav.php');
?>


    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      
<div class="container my-3">
      <h2>Notes</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">

          <thead class="thead-dark">
            <tr>
              <th>Id</th>
              <th>Username</th>
              
              <th>Update</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <?php 
         
  while($row = $result->fetch_assoc()) {
          echo '
          <tbody> 
            <tr>
              <td> '.$row["id"].'</td>
              <td>'.$row["username"].'</td>
                        
              <td>'.$row["dt"].'</td>';?>

              <td><a href="#" >Edit</a></td>
              <td > 
               

                 <button class="btn btn-light float-right" id="<?php echo $row['id']; ?>" onclick="delete_click(this.id)">
         <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill float-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
        </svg></button> 
      </td>

            </tr>
           <?php echo '
          </tbody>';
          }  ?>
        </table>
      </div>
    </div>
      
    </main>
  </div>
</div>
<script type="text/javascript">
  function delete_click(clicked_id)
  {
    var id = clicked_id;
    var txt;
  if (confirm("Are you sure to delete this?")) {
    
    location.replace('?id='+id);
  } else {
    txt = "You pressed Cancel!";
  }
   
       
     
  }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard.js"></script></body>
</html>
