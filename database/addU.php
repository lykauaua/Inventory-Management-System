<!-- ADD for USers -->
<?php

	 session_start();
	 //capture the table mappings
	 include('table_columns.php');


	 //capture the table name
	 $table_name = $_SESSION['table'];
	 $columns = $tables_columns_mapping[$table_name];

	 //loop through the columns
	 $db_arr =[];
	 $user = $_SESSION['user'];
	 	foreach ($columns as $column) {
	 		if(in_array($column, ['created_at', 'updated_at'])) $value = date("Y-m-d H:i:s");
	 		else if ($column == 'created_by') $value = $user['ID'];
	 		else if ($column == 'password') $value = password_hash($_POST[$column], PASSWORD_DEFAULT);
	 		else if ($column == 'img'){
	 			//upload or move the file to our directory
	 			$target_dir = "../uploads/equipments/";
	 			$file_data = $_FILES[$column];
	 			$file_name = $file_data['name'];

	 			$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
	 			$file_name = 'equipment - '. time().'.'.$file_ext;
	 			$check = getimagesize($file_data['tmp_name']);

	 			if($check){
	 				//move the file
	 				if(move_uploaded_file($file_data['tmp_name'], $target_dir . $file_name)){
	 					$value = $file_name;
	 				}
	 			}else{

	 			}




	 			//save the path to out database
	 		}
	 		else $value = isset($_POST[$column]) ? $_POST[$column] :''; 
	 		$db_arr[$column]=$value;
	 		
	 	}
	 	$table_properties = implode(", ", array_keys($db_arr)); 
	 	$table_placeholder = ':' . implode(", :", array_keys($db_arr));
	 	
	
	 try{
	 	$sql = "INSERT INTO 
	 						$table_name($table_properties)
	 					VALUES
	 						($table_placeholder)";
	 include('connection.php');
	 $stmt = $conn ->prepare($sql);
	 $stmt->execute($db_arr);
	 $response = [
	 	'success' => true,
	 	'message' => 'has been successfully added to the system.'];
	 
	}catch(PDOException $e){
		$response = [ 
			'success' => false,
			'message' => $e->getMessage()];
	}
	$_SESSION['response'] = $response;
	header('location: ../' .$_SESSION['redirect_to']);
	 
?>