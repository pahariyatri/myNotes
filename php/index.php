<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: /app/login.php");
    exit;
}

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Core PHP!</title>
  </head>
  <body>
	<?php require 'C:\xampp\htdocs\app\include\nav.php' ?>
	<div class="container my-3">
		<h1>
			<?php
				echo "PHP Tutorial";	
			?>
		</h1>
		
		<div class="accordion" id="accordionExample">
		<?php
		 include 'C:\xampp\htdocs\app\include\conn.php';
		 $sql = "SELECT * FROM `notes` WHERE Tcate = 'Programing'";
			$records = $conn->query($sql);
			foreach( $records as $data ) // using foreach  to display each element of array
            {
				
			
		?>
	 
	   
	  <div class="card">
		<div class="card-header" id="headingTwo">
		  <h2 class="mb-0">
			<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo $data["id"]; ?>" aria-expanded="false" aria-controls="collapse<?php echo $data["id"]; ?>">
			  <?php   
            //records as in an array

			
                echo $data['Tname'];           
       ?>
			</button>
		  </h2>
		</div>
		<div id="collapse<?php echo $data["id"]; ?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
		  <div class="card-body">
		  <p>
		  <?php  
			echo substr($data["Tdesc"],"0","2");
			//print_r($data);
						
			?></p>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
			  Source Code
			</button>
			</div>
		</div>
		
	  <?php  
			echo " </div>";
			//print_r($data);
			}			
			?>
			

	</div>
	
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
show_source("index.php");
?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="location.href='source.php'" class="btn btn-primary">Output</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="example" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
show_source("index.php");
?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="location.href='source.php'" class="btn btn-primary">Output</button>
      </div>
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