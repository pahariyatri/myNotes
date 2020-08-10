<?php
session_start();
    if(!isset($_SESSION['username']) || $_SESSION['username']!=true){
     header("location: /app/login.php");
     exit;
  }
$showAlert = false;
$showError = false;

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="/app/include/bootstrap4.css">


    <title>Core PHP!</title>
  </head>
  <body>

	<?php require 'include/nav.php' ?>

    <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> '. $showAlert.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    ?>
	<div class="container my-3">
		
		<div class="card">
      
			<?php
			include 'include/conn.php';
				if(isset($_POST['submit']) )
				{	
					$Tname = $_POST['Tname'];
					$sql = "SELECT * FROM notes WHERE Tname ='$Tname'";
					$records = $conn->query($sql);
							foreach( $records as $data ) // using foreach  to display each element of array
				            {
								?>
						  <div class="card-body">
							<h5 class="card-title"><?php echo $data['Tname']; ?></h5>
							<p class="card-text"><?php echo $data['Tdesc']; ?></p>
							<a href="#" class="btn btn-primary">Go somewhere</a>
						  
						<?php echo '</div>';
							}	
					echo '</div>';
				}
				else{
						
					 $id = $_GET['id'];
					 //echo "$id";
					 $sql = "SELECT * FROM notes WHERE Tid ='$id'";
					 //echo "$sql";
						$records = $conn->query($sql);
						foreach( $records as $data ) // using foreach  to display each element of array
			            {
							
						
					?>
	
  <div class="card-header">

   <?php echo $data['Tname']; ?>
   <?php 
    $tid = $data['Tid'];

      if ($_SESSION['username']==$data['username']) {
        echo '<a class="btn btn-outline-success mr-2 my-sm-2 float-right" href="/app/edit.php?id='.$tid.'" data-toggle="modal" data-target="#exampleModal">Edit</a>';
      }else{
        echo '<a class="btn btn-outline-success mr-2 my-sm-2 float-right">Add</a>';
      }
    ?>
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p><?php echo $data['Tdesc']; ?></p>
      <footer class="blockquote-footer">Post By : <cite title="Post By "><?php echo $data['username']; ?></cite></footer>
    </blockquote>
    
   

			
			<?php echo '</div>';
			}
			}
			?>

	</div>
		<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form action="/app/edit.php?id=<?php echo $tid;?>" method="post">
          <div class="form-group">
          
            <label for="exampleFormControlInput1">Topic Name</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="Tname" placeholder="topic name">
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Topic Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="Tdesc" rows="3"></textarea>
          </div>
          
          <div class="form-group">
            <label for="exampleFormControlFile1">Example file input</label>
            <input type="file" class="form-control-file" name ="Tsource" id="exampleFormControlFile1">
          </div>
          
        
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>