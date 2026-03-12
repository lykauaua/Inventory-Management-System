<!-- FOR ADDING OF TOOLS -->
<?php
    //start of session

    session_start();
    //logout(ed) users shouldn't have access to the dashboard, redirect to login page
    if(!isset($_SESSION['user'])) header('location: login.php');
    $_SESSION['table'] = 'tools';
    $_SESSION['redirect_to'] = 'add-tools.php';
    $user = $_SESSION['user'];
    

?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IMS: ADD TOOLS</title>
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
                        <h2 class="AddUserHeader"><i class = "fas fa-plus"></i> Add Tools</h2>
                        <div class="content-main">
                            <div class="userAddFormContainer">
                              <form action="database/addT.php" method="POST" class= "appForm" id="appForm" enctype="multipart/form-data">

                            <div class="appFormInputContainer">
                                <label for="serial_num" class="appFormAtt" >Serial No.</label>
                                <input type="number" id="serial_num" name="serial_num" placeholder="Enter the serial no. of the tools.." class="appFormInput">
                            </div>

                            <div class="appFormInputContainer">
                                <label for="equip_name" class="appFormAtt" >Tools Name</label>
                                <input type="text" id="equip_name" name="equip_name" placeholder="Enter tools name.. eg. 'Hammer' " class="appFormInput" required>
                            </div>
                            <div class="appFormInputContainer">
                                <label for="quantity" class="appFormAtt" >Quantity</label>
                                <input type="number" id="quantity" name="quantity" placeholder="Enter the quantity of the tools" class="appFormInput">
                            </div>
                             <div class="appFormInputContainer">
                                <label for="status" class="appFormAtt" >Status</label>
                                <select class = "dropDownStatus" name="status" id="status">
                                    <option selected disabled>Choose a status</option>
                                    <option style="padding: 4px 4px; background: lightgreen;">Good Condition</option>
                                    <option style="padding: 4px 4px; background: orange;">Needs Relief</option>  
                                </select>
                            </div>
                           <div class="appFormInputContainer">
                            <label for="remarks" class="appFormAtt">Remarks</label>
                            <select id="remarksSelect" name="remarksSelect" class="appFormInputRe" onchange="toggleRemarksInput()" style="margin-right: 10px;">
                                <option value="input" style="padding: 4px 4px; background: orange;">Add remarks</option>
                                <option value="noRemarks" style="padding: 4px 4px; background: lightgreen;">No Remarks</option>
                            </select>
                            <input type="text" id="remarksInput" name="remarksInput" placeholder="Add remarks" class="appFormInputRe" required style="display: inline;" />
                        </div>

                            <div class="appFormInputContainer">
                                <label for="maintenance" class="appFormAtt" >Maintenance Date:</label>
                                <input type="datetime-local" name="maintenance" class="form-control appFormInput" placeholder="Select date">

                                <label for="acquisition_date" class="appFormAtt" >Acquisition Date:</label>
                                <input type="datetime-local" name="acquisition_date" class="form-control appFormInput" placeholder="Select date">
                            </div>

                           <div class="appFormInputContainer">
                                <label for="brand_model" class="appFormAtt" >Brand Model</label>
                                <input type="text" id="brand_model" name="brand_model" placeholder=" brandX-1234"class="appFormInput" style="width:30%;">

                                <label for="location" class="appFormAtt" >Location</label>
                                <input type="text" id="location" name="location" placeholder="Eg. CpE Lab" class="appFormInput"style="width:30%;">
                            </div>
                               <div class="appFormInputContainer" id="img" >
                                <label for="img" class="appFormAtt" >Tools Image</label>
                                <input type="file" name="img" required>
                            
                            </div>
                            <button type="submit" class="btnAddUser"> <i class="fas fa-user-plus"></i>Add</button>
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
                                            text: "Tool has been added to the system.",
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script name="forMaintenance">
   flatpickr("input[type=datetime-local]", {});

</script>
</body>
</html>
