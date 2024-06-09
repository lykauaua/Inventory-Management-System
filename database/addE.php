<!-- FOR ADDING EQUIPMENY -->

<?php
session_start();
// Capture the table mappings
include('table_columns.php');

// Capture the table name
$table_name = $_SESSION['table'];
$columns = $tables_columns_mapping[$table_name];

// Loop through the columns
$db_arr = [];
$user = $_SESSION['user'];

foreach ($columns as $column) {
    if (in_array($column, ['created_at', 'updated_at'])) {
        $value = date("Y-m-d H:i:s");
    } else if ($column == 'created_by') {
        $value = $user['ID'];
    } else if ($column == 'password') {
        $value = password_hash($_POST[$column], PASSWORD_DEFAULT);
    } else if ($column == 'img') {
        // Upload or move the file to our directory
        $target_dir = "../uploads/equipments/";
        $file_data = $_FILES[$column];
        $file_name = $file_data['name'];
        
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_name = 'equip -' . time() . '.' . $file_ext;
        $check = getimagesize($file_data['tmp_name']);

        if ($check) {
            // Move the file
            if (move_uploaded_file($file_data['tmp_name'], $target_dir . $file_name)) {
                $value = $file_name;
            }
        }
    } else if ($column == 'remarks') {
        // Determine the value for remarks based on the select option
        $remarksSelect = $_POST['remarksSelect'];
        $remarksInput = $_POST['remarksInput'];
        if ($remarksSelect == 'noRemarks') {
            $value = 'No Remarks';
        } else {
            $value = $remarksInput;
        }
    } else {
        $value = isset($_POST[$column]) ? $_POST[$column] : '';
    }
    $db_arr[$column] = $value;
}

$table_properties = implode(", ", array_keys($db_arr)); 
$table_placeholder = ':' . implode(", :", array_keys($db_arr));

try {
    $sql = "INSERT INTO 
                    $table_name($table_properties)
                VALUES
                    ($table_placeholder)";
    include('connection.php');
    $stmt = $conn->prepare($sql);
    $stmt->execute($db_arr);
    $response = [
        'success' => true,
        'message' => 'Tool has been successfully added to the system.'
    ];
} catch (PDOException $e) {
    $response = [ 
        'success' => false,
        'message' => $e->getMessage()
    ];
}

$_SESSION['response'] = $response;
header('Location: ../' . $_SESSION['redirect_to']);
?>
