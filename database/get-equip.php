<?php
include('connection.php');

$ID = $_GET['ID'];


	$stmt = $conn->prepare("SELECT * FROM equipment WHERE ID =  $ID");
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	echo json_encode($row);
	
?>