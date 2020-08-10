<?php
	session_start();
	if(!isset($_SESSION['username']) || $_SESSION['username']!=true){
		header("location: /app/login.php");
		exit;
	}

	 // if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
			
	   // }
	// echo $_SESSION['username'];
	include 'include/conn.php';
	$showAlert = false;
	$showError = false;
	if(isset($_POST['submit']) )
	{
		$username = $_SESSION['username'];
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
		
		$Tsource= $_POST['Tsource'];
	
		$sql = "INSERT INTO notes (username, Tname, Tdesc,  Tsource) VALUES ( '$username','$Tname', '$Tdesc', '$Tsource')";

		if(mysqli_query($conn, $sql)){
			
			$last_id = mysqli_insert_id($conn);
			echo $last_id;
			$showAlert = true;
				header("location: user_notes.php");
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
  	<script src="/app/include/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
         tinymce.init({
            selector:'#editor',
            menubar: false,
            statusbar: false,
            plugins: 'autoresize anchor autolink charmap code codesample directionality fullpage help hr image imagetools insertdatetime link lists media nonbreaking pagebreak preview print searchreplace table template textpattern toc visualblocks visualchars',
            toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help fullscreen ',
            skin: 'bootstrap',
            toolbar_drawer: 'floating',
            min_height: 200,           
            autoresize_bottom_margin: 16,
            setup: (editor) => {
                editor.on('init', () => {
                    editor.getContainer().style.transition="border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out"
                });
                editor.on('focus', () => {
                    editor.getContainer().style.boxShadow="0 0 0 .2rem rgba(0, 123, 255, .25)",
                    editor.getContainer().style.borderColor="#80bdff"
                });
                editor.on('blur', () => {
                    editor.getContainer().style.boxShadow="",
                    editor.getContainer().style.borderColor=""
                });
            }
        });
</script>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="/app/include/bootstrap4.css">


    <title>iNotes-Add Notes</title>
  </head>
  <body>
    <?php require 'include/nav.php' ?>
    <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
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
   
  <div class="row justify-content-md-center">
    <div class="col-md-12 col-lg-8">
      <h1 class="h2 mb-4">Add Your Notes Here</h1>
      <form action="/app/form.php" method="post">
	      <div class="form-group">
	        <label for="exampleFormControlInput1">Topic Name</label>
	        <input type="text" class="form-control" id="exampleFormControlInput1" name="Tname">
	      </div>
	      <div class="form-group">
	        <label for="exampleFormControlTextarea1">Topic Description</label>
	        <textarea class="form-control" id="editor" name="Tdesc" rows="3"></textarea>
	      </div>
	     
	      
	      <div class="form-group">
	        <label for="exampleFormControlFile1">Example file input</label>
	        <input type="file" class="form-control-file" name ="Tsource" id="exampleFormControlFile1">
	      </div>
	      
	    
	        
	    
	      <div class="form-group">
	        
	        <button type="submit" name="submit" class="btn btn-outline-success mr-2 my-sm-2">Save</button>
	    	</div>
        </form>
    </div>
  </div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>