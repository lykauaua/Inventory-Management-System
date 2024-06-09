<?php 
    session_start();

    if(isset($_SESSION['user'])) {
        header('location: view-list.php'); 
        exit();
    } 

    $error_message = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        include('database/connection.php');
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Use prepared statement to prevent SQL injection
        $query = 'SELECT * FROM users WHERE email = ?';
        $stmt = $conn->prepare($query);
        $stmt->execute([$username]);

        if($stmt->rowCount() > 0){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Check if the password is hashed
            if (password_verify($password, $user['password'])) {
                // Capture data of currently logged in user
                $_SESSION['user'] = $user;
                header('Location: dashboard.php');
                exit();
            } elseif ($password === $user['password']) {
                // Password is not hashed, but matches
                $_SESSION['user'] = $user;
                header('Location: dashboard.php');
                exit();
            } else {
                $error_message = 'Invalid username or password. Please try again.';
            }
        } else {
            $error_message = 'Invalid username or password. Please try again.';
        }
    }   
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>IMS:LOGIN</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<div class="cdmBG">	
		<div class="loginHeader">
			<h1 style="font-size: 65px; margin-bottom:50px;">Central Storage Room</h1>
			<h3 style="font-size: 30px; margin-bottom:40px;">Inventory Management System</h3>
		</div>
		<!-- Start of login body -->
		<div class="loginBody">
            <form action="login.php" method="POST">
                <div class="loginInput">
                    <label for="">Please Log-In</label>
                    <input type="text" name="username" placeholder="username@cdm.edu.ph">
                </div>
                <div class="loginInput">
                    <input type="password" name="password" placeholder="password">
                </div>
                <div class="loginInput">
                    <button><i class="fas fa-sign-in-alt"></i> LOGIN</button>
                </div>
            </form>
        </div>
    </div>
    <!-- //End of login body
    //for the error message -->
    <?php 
        if(!empty($error_message)){ ?>    
            <div class="errorMessage">
            <strong>Error:</strong> <p><?= $error_message ?></p>
            </div>
    <?php } ?>
</body>
</html>
