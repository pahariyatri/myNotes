<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "test";

$conn = mysqli_connect($server, $username, $password, $database);

// Check connection

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
 
echo "Connected successfully";
 
$sql = "SELECT * FROM php";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["username"]. "<br>";
  }
} else {
  echo "0 results";
}


if(isset($_POST['submit'])){
	echo "echl";
    $username = $_POST["username"];
    $Tname = $_POST["Tname"];
    $Tdescription = $_POST["Tdescription"];
	$Tsource = $_POST["Tsource"];
    // $exists=false;
	
   //INSERT INTO `php` (`username`, `id`, `Tname`, `Tdescription`, `Tsource`, `public`) VALUES ('adm', NULL, 'jlkj', 'lkjlk', '', '1');
    $sql = "INSERT INTO php  ( `Tname`, `Tdescription`, `Tsource`) VALUES ('$username', '$Tname','$Tdescription','$Tsource','')";
	echo $sql ;
	if (mysqli_query($conn, $sql)) {
		  echo "New record created successfully";
	} else {
		  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}  
?>