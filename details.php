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
		<div class="card">
<?php
if(isset($_POST['submit']) ){
	
		include 'include/conn.php';
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
			



		 include 'include/conn.php';
		 $id = $_GET['id'];
		 $sql = "SELECT * FROM notes WHERE id ='$id'";
			$records = $conn->query($sql);
			foreach( $records as $data ) // using foreach  to display each element of array
            {
				
			
		?>
		  <div class="card-body">
			<h5 class="card-title"><?php echo $data['Tname']; ?></h5>
			<p class="card-text"><?php echo $data['Tdesc']; ?></p>
			<a href="#" class="btn btn-primary">Go somewhere</a>
		  
		</div>
			
			<?php echo '</div>';
			}
			}
			?>

	</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>