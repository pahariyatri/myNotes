<?php
	require_once('include/conn.php');
	 
	function tname($conn , $term){ 
	 $query = "SELECT * FROM notes WHERE Tname LIKE '%".$term."%' ORDER BY Tname ASC";
	 $result = mysqli_query($conn, $query); 
	 $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
	 return $data; 
	}
	 
	if (isset($_GET['term'])) {
	 $topicname = tname($conn, $_GET['term']);
	 $topicName = array();
	 foreach($topicname as $tname){
	 $topicName[] = $tname['Tname'];
	 }
	 echo json_encode($topicName);
	}
?>