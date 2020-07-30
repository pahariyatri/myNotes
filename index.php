<?php
session_start();

	include 'include/conn.php';

	$keyword = strval($_POST['query']);
	$search_param = "{$keyword}%";
	
	$sql = $conn->prepare("SELECT * FROM notes WHERE Tname LIKE ?");
	$sql->bind_param("s",$search_param);			
	$sql->execute();
	$result = $sql->get_result();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		$countryResult[] = $row["Tname"];
		}
		echo json_encode($countryResult);
	}
	$conn->close();


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<style>
	.typeahead { border: 2px solid #FFF;border-radius: 4px;padding: 8px 12px;max-width: 300px;min-width: 290px;background: rgba(66, 52, 52, 0.5);color: #FFF;}
	.tt-menu { width:300px; }
	ul.typeahead{margin:0px;padding:10px 0px;}
	ul.typeahead.dropdown-menu li a {padding: 10px !important;	border-bottom:#CCC 1px solid;color:#FFF;}
	ul.typeahead.dropdown-menu li:last-child a { border-bottom:0px !important; }
	.bgcolor {max-width: 550px;min-width: 290px;max-height:340px;background:url("world-contries.jpg") no-repeat center center;padding: 100px 10px 130px;border-radius:4px;text-align:center;margin:10px;}
	.demo-label {font-size:1.5em;color: #686868;font-weight: 500;color:#FFF;}
	.dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover {
		text-decoration: none;
		background-color: #1f3f41;
		outline: 0;
	}
	</style>	
    <title>iNotes</title>
  </head>
  <body>
	<?php require 'include/nav.php' ?>	

<div class="jumbotron">
  <div class="container text-center form-center">
    <h1 class="display-4">Fluid jumbotron</h1>
    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
	<form action = "details.php" method = "POST">
		<div class="form-group">
			<input type="text" class="form-control" id="Tname" name="Tname" placeholder="Topic name"class="typeahead" >
		</div>
		<button type="submit" name="submit" class="btn btn-outline-dark">Search</button
	</form>
	
	

	
  </div>
</div>	
	<div class="container my-3">
	
		<div class="row row-cols-1 row-cols-md-3">
		<?php
		 include 'include/conn.php';
		 $sql = "SELECT * FROM notes";
			$records = $conn->query($sql);
			foreach( $records as $data ) // using foreach  to display each element of array
            {
				
			
		?>
		  <div class="col mb-4">
			<div class="card h-100">
			  <div class="card-body">
				<h5 class="card-title"><?php echo $data['Tname']; ?> </h5>
				<p class="card-text"><?php echo substr($data["Tdesc"],"0","200");;?><br><a class="btn btn-outline-dark btn-sm my-3" 
				href="details.php?id=<?php echo $data['Tid']; ?>"> more</a></p>
				
			  </div>
			  
			  
			  <div class="card-footer">
			  
			  <small class="text-muted">Last updated <?php echo $data['dt']; ?></small>
			  
			</div>
			</div>
			<?php echo '</div>';
			}
		?>
		  
		  
		</div>

	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>