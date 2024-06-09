<!-- FOR VIEWING INVENTORY FOR ALL OF THE STORAGE -->
<?php
    //start of session
    session_start();
    //logout(ed) users shouldn't have access to the dashboard, redirect to login page
    if(!isset($_SESSION['user'])) header('location: login.php');
    /*$_SESSION['table'] = 'equipment';
    $equipment = include('database/show.php');*/
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IMS: VIEW STORAGE</title>
    
    <?php include('partials/app-header-scripts.php'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />

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
                        <h2 class="AddUserHeader"><i class="fas fa-list-ul"></i> Storage List </h2>
                         
                        <div class="AddUserContent">
                            <div class="Users">
                                <table id="myTable" style="border: 1px solid #9f9e85 ; padding: 1px ; margin-top: 20px ; font-family: monospace ; border-collapse: separate; border-spacing: 2px; text-align: center; width: 100%;">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th>#</th>
                                            <th>Serial No.</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Brand Model</th>
                                            <th>Created By</th>
                                            <th>Location</th>
                                            <th>Remarks</th>
                                            <th>Status</th>
                                            <th>Maintenance</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php
                                        $connect = mysqli_connect("localhost", "root", "", "ims system") or die("Connection Failed");
                                        $query = "SELECT * FROM equipment";
                                        $result = mysqli_query($connect, $query); 
                                        $index = 0; // Initialize index variable

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $index++; // Increment index for each row
                                        ?>
                                        <tr>
                                            <td><?= $index ?></td>
                                            <td class="serial_num"><?php echo $row['serial_num'] ?></td>
                                            <td class="img">
                                                <img class="equip_img" src="uploads/equipments/<?php echo $row['img']?>" >
                                            </td>
                                            <td class="equip_name"><?php echo $row['equip_name'] ?></td>
                                            <td class="quantity"><?php echo $row['quantity'] ?></td>
                                            <td class="brand_model"><?php echo $row['brand_model'] ?></td>
                                            <td>
                                                <?php 
                                                $equipId = $row['created_by'];
                                                $stmt = $connect->prepare("SELECT * FROM users WHERE id = ?");
                                                $stmt->bind_param("i", $equipId);
                                                if ($stmt->execute()) {
                                                    $result_user = $stmt->get_result();
                                                    if ($result_user->num_rows > 0) {
                                                        $user_row = $result_user->fetch_assoc();
                                                        echo $user_row['name'];
                                                    } else {
                                                        echo "User not found"; 
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td class= "location" style="font-weight: bold;"><?php echo $row['location'] ?></td>
                                            <td class="remarks">
                                                <?php if ($row['remarks'] == 'No Remarks'): ?>
                                                    <span class="status-green" ><?= htmlspecialchars($row['remarks']) ?></span>
                                                <?php else: ?>
                                                    <span class="status-orange"><?= htmlspecialchars($row['remarks']) ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="status">
                                                
                                                <?php if ($row['status'] == 'Serviceable'): ?>
                                                <span class="status-green"><?= $row['status'] ?></span>
                                                <?php elseif ($row['status'] == 'Not Serviceable'): ?>
                                                <span class="status-orange"><?= $row['status'] ?></span>
                                                <?php else: ?>
                                                    <?= $row['status'] ?>
                                                <?php endif; ?>
                                            </td>
                                            
                                            <td><?php echo $row['maintenance'] ?></td>
                                        </tr> 
                                        <?php
                                        } 
                                        ?>

                                        <?php
                                        // Now fetch data from the 'tools' table
                                        $query_tools = "SELECT * FROM tools";
                                        $result_tools = mysqli_query($connect, $query_tools); 

                                        while ($row = mysqli_fetch_assoc($result_tools)) {
                                            $index++; // Increment index for each row
                                        ?>
                                        <tr>
                                            <td><?= $index ?></td>
                                            <td class="serial_num"><?php echo $row['serial_num'] ?></td>
                                            <td class="img">
                                                <img class="equip_img" src="uploads/tools/<?php echo $row['img']?>" >
                                            </td>
                                            <td class="equip_name"><?php echo $row['equip_name'] ?></td>
                                            <td class="quantity"><?php echo $row['quantity'] ?></td>
                                            <td class="brand_model"><?php echo $row['brand_model'] ?></td>
                                            <td>
                                                <?php 
                                                $equipId = $row['created_by'];
                                                $stmt = $connect->prepare("SELECT * FROM users WHERE id = ?");
                                                $stmt->bind_param("i", $equipId);
                                                if ($stmt->execute()) {
                                                    $result_user = $stmt->get_result();
                                                    if ($result_user->num_rows > 0) {
                                                        $user_row = $result_user->fetch_assoc();
                                                        echo $user_row['name'];
                                                    } else {
                                                        echo "User not found"; 
                                                    }
                                                }
                                                ?>
                                            </td>
                                             <td class= "location" style="font-weight: bold;"><?php echo $row['location'] ?></td>
                                            
                                            <td class="remarks">
                                                <?php if ($row['remarks'] == 'No Remarks'): ?>
                                                    <span class="status-green" ><?= htmlspecialchars($row['remarks']) ?></span>
                                                <?php else: ?>
                                                    <span class="status-orange"><?= htmlspecialchars($row['remarks']) ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="status">
                                                
                                                <?php if ($row['status'] == 'Good Condition'): ?>
                                                <span class="status-green"><?= $row['status'] ?></span>
                                                <?php elseif ($row['status'] == 'Needs Relief'): ?>
                                                <span class="status-orange"><?= $row['status'] ?></span>

                                                <?php else: ?>
                                                    <?= $row['status'] ?>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo $row['maintenance'] ?></td>
                                        </tr> 
                                        <?php 
                                        } 
                                        ?>

                                        <?php
                                        // Now fetch data from the 'consumables' table
                                        $query_tools = "SELECT * FROM consumables";
                                        $result_tools = mysqli_query($connect, $query_tools); 

                                        while ($row = mysqli_fetch_assoc($result_tools)) {
                                            $index++; // Increment index for each row
                                        ?>
                                        <tr>
                                            <td><?= $index ?></td>
                                            <td class="serial_num"><?php echo $row['serial_num'] ?></td>
                                            <td class="img">
                                                <img class="equip_img" src="uploads/consumables/<?php echo $row['img']?>" >
                                            </td>
                                            <td class="equip_name"><?php echo $row['equip_name'] ?></td>
                                            <td class="quantity"><?php echo $row['quantity'] ?></td>
                                            <td class="brand_model"><?php echo $row['brand_model'] ?></td>
                                            <td>
                                                <?php 
                                                $equipId = $row['created_by'];
                                                $stmt = $connect->prepare("SELECT * FROM users WHERE id = ?");
                                                $stmt->bind_param("i", $equipId);
                                                if ($stmt->execute()) {
                                                    $result_user = $stmt->get_result();
                                                    if ($result_user->num_rows > 0) {
                                                        $user_row = $result_user->fetch_assoc();
                                                        echo $user_row['name'];
                                                    } else {
                                                        echo "User not found"; 
                                                    }
                                                }
                                                ?>
                                            </td>
                                             <td class= "location" style="font-weight: bold;"><?php echo $row['location'] ?></td>
                                            
                                            <td class="remarks">
                                                <?php if ($row['remarks'] == 'No Remarks'): ?>
                                                    <span class="status-green" ><?= htmlspecialchars($row['remarks']) ?></span>
                                                <?php else: ?>
                                                    <span class="status-orange"><?= htmlspecialchars($row['remarks']) ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="status">
                                                
                                                <?php if ($row['status'] == 'Available'): ?>
                                                <span class="status-green"><?= $row['status'] ?></span>
                                                <?php elseif ($row['status'] == 'Unavailable'): ?>
                                                <span class="status-orange"><?= $row['status'] ?></span>
                                                <?php elseif ($row['status'] == 'Expired'): ?>
                                                <span class="status-orange"><?= $row['status'] ?></span>                                                
                                                <?php else: ?>
                                                    <?= $row['status'] ?>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo $row['maintenance'] ?></td>
                                        </tr>
                                        <?php
                                        } 
                                        ?>
                                    </tbody>
                                </table>
                                <p class="equip_count"><?= $index ?> items </p>
                            </div>
                            <div class="legend">
                                <img src="pics/legend.png" alt="legend.png">
                            </div>
                            <div class="credits" id="credits">
                            <p style="margin-top:10px;">Colegio de Muntinlupa | © 2024 | CPE2 - Software Design ~ All rights reserved.</p> 
                            </div>
                        </div>
                    </div>
                </div>
         

    </div>
</div>
<?php include('partials/app-scripts.php'); ?>
<?php include('partials/table-scripts.php');?>
<script>
  $(document).ready( function () {
    $('#myTable').DataTable();
  });
</script>

</body>
</html>
