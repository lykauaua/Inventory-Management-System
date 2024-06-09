<?php
    // Start of session
    session_start();

    // If user is not logged in, redirect to login page
    if(!isset($_SESSION['user'])) {
        header('location: login.php');
        exit();
    }

    // Set session variables
    $_SESSION['table'] = 'users';
    $_SESSION['redirect_to'] = 'users-add.php';
    $user = $_SESSION['user'];
    $users = include('database/show.php');

?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IMS: ADD USER</title>
    <?php include('partials/app-header-scripts.php'); ?>

</head>
<body>
<div class ="dashboard-container" id="dashboard_container">
    <?php include('partials/app-sidebar.php')?> 
    <div class="content-container" id="content_container">
        <?php include('partials/app-topNav.php')?>
        <div class="content"> <!-- 
            <div class="contentBlue"></div>
            <div class="contentYellow"></div>
            <div class="contentRed"></div> -->
            </div> <!-- yung color bar between topNav saka content-main -->
                <div class="row">
                    <div class="column column-12">
                        <h2 class="AddUserHeader"><i class="fas fa-plus"></i> Add User</h2>
                        <div class="content-main">
                            <div class="userAddFormContainer">
                                <form action="database/addU.php" method="POST" class="appForm" id="appForm" onsubmit="return validateForm()">
                                    <div class="appFormInputContainer">
                                        <label for="name" class="appFormAtt">Name</label>
                                        <input type="text" id="name" name="name" class="appFormInput">
                                    </div>
                                    <div class="appFormInputContainer">
                                        <label for="email" class="appFormAtt">Email</label>
                                        <input type="text" id="email" name="email" class="appFormInput">
                                    </div>
                                    <div class="appFormInputContainer">
                                        <label for="password" class="appFormAtt">Password</label>
                                        <input type="password" id="password" name="password" class="appFormInput">
                                    </div>
                                    <button type="submit" class="btnAddUser"> <i class="fas fa-user-plus"></i>Add User</button>
                                </form>
                                <?php 
                                if(isset($_SESSION['response'])){ 
                                    $response_message = $_SESSION['response']['message'];
                                    $is_success = $_SESSION['response']['success'];
                                    ?> 
                                    <script>
                                    <?php if($is_success): ?>
                                        Swal.fire({
                                            title: "Success!",
                                            text: "User has been added to the system.",
                                            imageUrl: "/SYSTEM/pics/yu.gif",
                                            imageWidth: 200,
                                            imageHeight: 100,
                                            imageAlt: "octo-gif"
                                        });
                                    <?php else: ?>
                                        Swal.fire({
                                            title: 'Error!',
                                            text: '<?= $response_message ?>',
                                            icon: 'error'
                                        });
                                    <?php endif; ?>
                                    </script>
                                <?php 
                                    unset($_SESSION['response']); 
                                } 
                                ?> 
                            </div>
                        </div>                    
                    </div>
                </div>
                <?php include('partials/app-scripts.php'); ?>
                <script src="js/sweetalert2.js"></script>
                <script>
                function validateForm() {
                    var name = document.getElementById("name").value;
                    var email = document.getElementById("email").value;
                    var password = document.getElementById("password").value;

                    if (name === "" || email === "" || password === "") {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Please fill in all fields.',
                            icon: 'error'
                        });
                        return false; // Prevent form submission
                    }
                    return true; // Allow form submission
                }
                </script>
</body>
</html>
