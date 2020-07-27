<?php
	session_start();
	if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
		header("location: /app/login.php");
		exit;
	}

	 // if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
			
	   // }
	//echo $_SESSION['username'];
	$showAlert = false;
	$showError = false;
	if(isset($_POST['submit']) )
	{
		include 'include/conn.php';
		if(empty($_POST['Tname'])){
			$showError="Title is Missiong";
		}
		else{
		$Tname = $_POST['Tname'];
		
		if(empty($_POST['Tdesc'])){
			$showError="Title Description  also Compulsory";
		}
		else{
		
		$Tdesc = $_POST['Tdesc'];
		$Tcate = $_POST['Tcate'];
		$Tsource= $_POST['Tsource'];
		// Attempt insert query execution
		$sql = "INSERT INTO notes (Tname, Tdesc, Tcate, Tsource) VALUES ( '$Tname', '$Tdesc','$Tcate', '$Tsource')";

		if(mysqli_query($conn, $sql)){
			
			$last_id = mysqli_insert_id($conn);
			echo $last_id;
			$showAlert = true;
		} else{
			$showError ="ERROR: Could not able to execute $sql. " . mysqli_error($conn);
		}	
		}
	}
	}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>notes</title>
  </head>
  <body>
    <?php require 'include/nav.php' ?>
    <?php
    if($showAlert){
		echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Success!</strong> Your Notes added Successfully On database '.$last_id.'
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
    <div class="container my-4">
     <h1 class="text-center">Add Notes to our website</h1>
		<form action="/app/form.php" method="post">
			<div class="form-group">
				<label for="exampleFormControlInput1">Topic Name</label>
				<input type="text" class="form-control" id="exampleFormControlInput1" name="Tname" placeholder="topic name">
			</div>
			<div class="form-group">
				<label for="exampleFormControlTextarea1">Topic Description</label>
				<textarea class="form-control" id="exampleFormControlTextarea1" name="Tdesc" rows="3"></textarea>
			</div>
			<div class="form-group">
				<label for="exampleFormControlTextarea1">Topic Category</label>
				<select class="form-control" id="category" name="Tcate" required>
					<?php
					include('../app/include/conn.php');
					$query=mysqli_query($conn,"SELECT cate_name FROM category ORDER BY cate_name ASC")or die(mysqli_error());
					while($row=mysqli_fetch_array($query)){
					?>
					<option value="<?php echo $row['cate_name'];?>"><?php echo $row['cate_name'];?>
						<?php echo "</option>";}?>
                </select>
            </div>
			<div class="form-group">
				<label for="exampleFormControlFile1">Example file input</label>
				<input type="file" class="form-control-file" name ="Tsource" id="exampleFormControlFile1">
			</div>
			<button type="submit" name="submit" class="btn btn-primary">save</button>
		</form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
