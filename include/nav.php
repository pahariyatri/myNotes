
<?php 

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;

 
}
else{
  $loggedin = false;
}
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/app">iNotes</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/app/index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/app/user_notes.php">My Notes</a>
      </li>
  

      <li class="nav-item">
        <a class="nav-link" href="/app/form.php">Add Notes</a>
      </li>        
  </ul>
';

    
	if(!$loggedin){
      echo '
	  <a class="btn btn-outline-success mr-2 my-sm-2" href="/app/login.php">Login</a>
	  <a class="btn btn-outline-success mr-2 my-sm-2" href="/app/signup.php">Signup</a>';
	 }
      if($loggedin){		
      echo '
	  <a class="btn btn-outline-success mr-2 my-sm-2" href="/app/logout.php">Logout</a>
    ';
    }
	
  echo '</div>


</nav>';

?>


