<?php
$equip_name = $_POST['equip_name'];
$brand_model = $_POST['brand_model'];
$equipId = $_POST['equipid'];
$serialNum = $_POST['serial_num'];
$status = $_POST['status'];
$quantity = $_POST['quantity'];
$maintenance = $_POST['maintenance'];
$location = $_POST['location'];
$acquisition_date = $_POST['acquisition_date'];


// Process remarks based on selection
$remarksSelect = $_POST['remarksSelect'];
$remarksInput = $_POST['remarksInput'];
if ($remarksSelect == 'noRemarks') {
    $remarks = 'No Remarks';
} else {
    $remarks = $remarksInput;
}

$updated_at = date('Y-m-d H:i:s'); // Get current date and time

$target_dir = "../uploads/consumables/";
$file_name_value = NULL;
$file_data = $_FILES['img'];

if ($file_data['tmp_name'] !== '') {
    $file_name = $file_data['name'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_name = 'consume -' . time() . '.' . $file_ext;
    $check = getimagesize($file_data['tmp_name']);

    if ($check) {
        // Move the file
        if (move_uploaded_file($file_data['tmp_name'], $target_dir . $file_name)) {
            $file_name_value = $file_name; // Save the file_name to the database
        }
    }
}

try {
    // Save to the database
    $sql = "UPDATE consumables  
            SET equip_name = ?, brand_model = ?, img = ?, serial_num = ?, status = ?, maintenance = ?, quantity = ?, location = ?, remarks = ?, updated_at = ?, acquisition_date = ?
            WHERE ID = ?";

    include('connection.php');
    $stmt = $conn->prepare($sql);
    // Correct order of parameters in execute() function
    $stmt->execute([$equip_name, $brand_model, $file_name_value, $serialNum, $status, $maintenance, $quantity, $location, $remarks, $updated_at, $acquisition_date, $equipId]);

    $response = [
        'success' => true,
        'message' => "<strong>$equip_name</strong> has been successfully updated in the system."
    ];
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => "Error processing your request: " . $e->getMessage()
    ];
}

echo json_encode($response);
?>
