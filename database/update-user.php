<?php
    $data = $_POST;
    $user_id = (int) $data['user_id'];
    $name =  $data['n_name'];
    $email =  $data['e_name'];

    
    try {
        $sql = "UPDATE users SET name=?, email=?, updated_at=? WHERE id=?";
        include('connection.php');
        $conn->prepare($sql)->execute([$name, $email, date('Y-m-d H:i:s'), $user_id]);

        echo json_encode([
            'success' => true,
            'message' => $name . ' ' . $email . ' has been successfully updated.'
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error processing your request.'
        ]);
    }
?>
