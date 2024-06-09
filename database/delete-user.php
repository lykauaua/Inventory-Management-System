<?php
	$data = $_POST;
	$user_id = (int) $data['user_id'];
	$name =  $data['n_name'];
	$email =  $data['e_name'];


	try{
	 	$command = "DELETE FROM users WHERE id = ($user_id)";

	 include('connection.php');
	 $conn->exec($command);
	 echo json_encode([
	 		'success' => true,
	 		'message' => $name.' '.$email. ' is successfully deleted.'
	 	]);
	 
	}catch(PDOException $e){
		echo json_encode([
	 		'success' => false,
	 		'message' =>  'Error processing your request.'
	 		]);
	}

?>