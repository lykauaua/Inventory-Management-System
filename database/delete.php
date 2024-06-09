<?php
	$data = $_POST;
	$id = (int) $data['id'];
	$table =  $data['table'];
	


	try{
	 	$command = "DELETE FROM $table WHERE id = ($id)";

	 include('connection.php');
	 $conn->exec($command);
	 echo json_encode([
	 		'success' => true,
	 		/*'message' => $name.' '.$email. ' is successfully deleted.'*/
	 	]);
	 
	}catch(PDOException $e){
		echo json_encode([
	 		'success' => false,
	 		/*'message' =>  'Error processing your request.'*/
	 		]);
	}

?>