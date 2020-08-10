<?php session_start();?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- jQuery UI -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />

	<!-- Bootstrap CSS -->

	 <link rel="stylesheet" type="text/css" href="/app/include/bootstrap4.css">


	<title>iNotes</title>
  </head>
  <body>
	<?php require 'include/nav.php' ?>	
	<div class="jumbotron">
	  <div class="container text-center form-center">
	    <h3 class="display-4">Search Notes</h3>
	    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>

		<form action = "details.php" method = "POST">
			<div class="form-group">
				<input type="text" class="form-control" id="Tname" name="Tname" placeholder="Topic name" >
			</div>
			<button type="submit" name="submit" class="btn btn-outline-dark">Search</button>
		</form>
	  </div>
	</div>	
		<div class="container my-3">
			<div class="row row-cols-1 row-cols-md-3">
			<?php
			 include 'include/conn.php';
			 $sql = "SELECT * FROM notes ORDER BY dt DESC";
				$records = $conn->query($sql);
				foreach( $records as $data ) // using foreach  to display each element of array
	            { ?>
			 <div class="col mb-4">
				<div class="card h-100">
					<div class="card-header">
					<?php echo $data['Tname']; ?> 
				  
					
				</div>
				<div class="card-body">
					<p class="card-text"><?php echo substr($data["Tdesc"],"0","200");?><br>
						<?php 
						// echo strlen($data['Tdesc']);
						$descLenth = strlen($data['Tdesc']);
						if ($descLenth>=200) {
							echo '<a class="card-link" href="details.php?id='. $data["Tid"].' ">Read More</a>';
						}
							
						?>
						<!-- <a class="card-link" href="details.php?id=<?php echo $data['Tid']; ?>">Read More</a> -->
					</p>
					<p class="card-text text-right font-italic"><small class="text-muted">- Last updated by <b> <?php echo $data['username']; ?></b> on <?php echo $data['dt']; ?></small></p>
				  </div>
				<!--   <div class="card-footer">
				  <small class="text-muted">Last updated by <b> <?php echo $data['username']; ?></b> on <?php echo $data['dt']; ?></small>
				  
				</div> -->
				</div>
<?php echo '</div>';
			} ?>  
		</div>

	</div>
	<div class="card-footer text-muted font-weight-light">
    2 days ago
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script> 
<script type="text/javascript">
	  $(function() {
	     $( "#Tname" ).autocomplete({
	       source: 'server.php',
	     });
	  });
	</script>   

  </body>
</html>