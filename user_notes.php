<?php
session_start();
	if(!isset($_SESSION['username']) || $_SESSION['username']!=true){
		header("location: /app/login.php");
		exit;
	}
	$user = $_SESSION['username'];

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="/app/include/bootstrap4.css">

    <title>iNotes-My Notes</title>
  </head>
  <body>
	<?php require 'include/nav.php' ;
	$showAlert = false;
	$showError = false;
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
			<div class="row row-cols-1 row-cols-md-3">
			<?php
			 include 'include/conn.php';
			 // SELECT * FROM `notes` WHERE username = 'Aaa'
			 $sql = "SELECT * FROM notes WHERE username ='$user'";
			 
				$records = $conn->query($sql);
				foreach( $records as $data ) // using foreach  to display each element of array
	            { 
	            	$tid = $data['Tid'];
	            	?>
			 <div class="col mb-4">
				<div class="card h-100">
				  
				  	<div class="card-header"><?php echo $data['Tname']; ?>
					
			<!-- <a href="delete.php?id=<?php echo $data['Tid']; ?>"> -->
				<button class="btn btn-light float-right" id="<?php echo $data['Tid']; ?>" onclick="delete_click(this.id)">
				 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill float-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				  <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
				</svg></button>
				<!-- </a> -->
				

				<a class="btn btn-light float-right" data-toggle="modal" data-target="#exampleModal" id="<?php echo $data['Tid']; ?>" onclick="edit_click(this.id)">

					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square float-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
					  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
					</svg>
					</a>
				

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
					
					<p class=" card-text text-right font-italic "><small class="text-muted">- Last updated on <?php echo $data['dt']; ?></small></p>
		


				  </div>
				  

			
				</div>
<?php echo '</div>';
			} ?>  
		</div>

	</div>

<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
          
          <div class="modal-body">
          	

            <form name="myform" method="post">
          <div class="form-group">
          
            <label for="exampleFormControlInput1">Topic Name</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="Tname" >
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Topic Description</label>
            <textarea class="form-control" id="editor" name="Tdesc" rows="3"></textarea>
          </div>
          
          <div class="form-group">
            <label for="exampleFormControlFile1">Example file input</label>
            <input type="file" class="form-control-file" name ="Tsource" id="exampleFormControlFile1">
          </div>
          
        
          
         
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="update"  class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>

<script src="https://cdn.tiny.cloud/1/nmiepf7hu98l8z8y1gb2rz8l5hj7jiluqfk7560j910vdl76/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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



    
<script type="text/javascript">
  function delete_click(clicked_id)
  {
  	var id = clicked_id;
  	var txt;
  if (confirm("Press a button!")) {
    location.replace('delete.php?id='+id);
  } else {
    txt = "You pressed Cancel!";
  }
   
       
     
  }

  function edit_click(clicked_id){
  	var id = clicked_id;
  	document.myform.action = get_action(id);
  
  }
  function get_action(id){ 
  	var form_action = 'edit.php?id='+id;
  	alert(form_action);
  	return form_action;
  	
  }

</script>

		
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    


 




  </body>
</html>