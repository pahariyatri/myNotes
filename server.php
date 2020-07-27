<?php		
	$keyword = strval($_POST['submit']);
	$search_param = "{$keyword}%";
	include 'include/conn.php';

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