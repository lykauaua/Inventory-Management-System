<!-- containter EQUIPMENT,CONSUMABLES, TOOLS -->
<?php
    //start of session

    session_start();
    //logout(ed) users shouldn't have access to the dashboard, redirect to login page
    if(!isset($_SESSION['user'])) header('location: login.php');

    $user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IMS:VIEW EQUIPMENTS AND TOOLS</title>
    
    <?php include('partials/app-header-scripts.php'); ?>
    <link rel="stylesheet" type="text/css" href="css/dashboard.css?v=<?=time();?>">
</head>
<body>
<div class ="dashboard-container" id="dashboard_container">
    <?php include('partials/app-sidebar.php')?>
    <div class="content-container" id="content_container">
        <?php include('partials/app-topNav.php')?>
        <div class="content">  
            <div class="content-main"> <!-- eto yung blue line  -->
            </div>
        </div>
            <div class="reportsContainer" >
                    <div class="reportTypeContainer" >
                        <div class="
                        reportType">
                            <p >Inventory for Tools</p>
                            <div style="text-align: right;">
                                <a href="view-tools.php" class="viewBtn">View and Edit Tools</a>
                                <a href="add-tools.php" class="viewBtn">Add Tools</a>
                            </div>
                        </div>
                        <div class="
                        reportType">
                            <p >Inventory for Equipment</p>
                            <div style="text-align: right;">
                                
                                <a href="view-equip.php" class="viewBtn">View and Edit Equipment</a>
                                <a href="add-equip.php" class="viewBtn">Add Equipment</a>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="reportsContainer"  style="display: flex; justify-content: center;">
                    <div class="reportTypeContainer" >
                        <div class="
                        reportType">
                            <p >Inventory for Consumables</p>
                            <div style="text-align: right;">
                                <a href="view-consumables.php" class="viewBtn">View and Edit Consumables</a>
                                <a href="add-consumables.php" class="viewBtn">Add Consumables</a>
                            </div>
                        </div> 
                    </div>
    </div>

</div>
<?php include('partials/app-scripts.php'); ?>
</body>
</html>
