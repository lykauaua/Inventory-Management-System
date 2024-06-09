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
    <title>IMS:DASHBOARD</title>
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
            <div class="row">
                 <div class="column column-12">
                        <h2 class="AddUserHeader"><i class="fas fa-list-ul"></i> Storage List </h2>
                         
                        <div class="AddUserContent">
                            <div class="Users">
                                <table id="view-list-table" style="border: 1px solid #9f9e85 ; padding: 3px ; margin-top: 25px ; font-family: monospace ; border-collapse: separate; border-spacing: 2px; text-align: center; width: 100%;">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th>#</th>
                                            <th>Serial No.</th>
                                            <th>Image</th>
                                            <th>Equipment Name</th>
                                            <th>Quantity</th>
                                            <th>Brand Model</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Status</th>
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
                                            <td><?php echo $row['created_at'] ?></td>
                                            <td><?php echo $row['updated_at'] ?></td>
                                            <td class="status">
                                                
                                                <?php if ($row['status'] == 'Serviceable'): ?>
                                                <span class="status-green"><?= $row['status'] ?></span>
                                                <?php elseif ($row['status'] == 'Not Serviceable'): ?>
                                                <span class="status-orange"><?= $row['status'] ?></span>
                                                <?php elseif ($row['status'] == 'Good Condition'): ?>
                                                        <span class="status-green"><?= $row['status'] ?></span>
                                                <?php elseif ($row['status'] == 'Needs Relief'): ?>
                                                        <span class="status-orange"><?= $row['status'] ?></span>

                                                <?php else: ?>
                                                    <?= $row['status'] ?>
                                                <?php endif; ?>
                                            </td>
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
                                            <td><?php echo $row['created_at'] ?></td>
                                            <td><?php echo $row['updated_at'] ?></td>
                                            <td class="status">
                                                <?php if ($row['status'] == 'Serviceable'): ?>
                                                <span class="status-green"><?= $row['status'] ?></span>
                                                <?php elseif ($row['status'] == 'Not Serviceable'): ?>
                                                <span class="status-orange"><?= $row['status'] ?></span>
                                                <?php elseif ($row['status'] == 'Good Condition'): ?>
                                                        <span class="status-green"><?= $row['status'] ?></span>
                                                <?php elseif ($row['status'] == 'Needs Relief'): ?>
                                                        <span class="status-orange"><?= $row['status'] ?></span>

                                                <?php else: ?>
                                                    <?= $row['status'] ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr> 
                                        <?php var_dump($row);die;
                                        } 
                                        ?>
                                    </tbody>
                                </table>
                                <p class="equip_count"><?= $index ?> items </p>
                            </div>

                        </div>
                    </div>
            </div>
    </div>

</div>
<?php include('partials/app-scripts.php'); ?>
<script>
  $(document).ready( function () {
    $('#view-list-table').DataTable();
  });
</script>
</script>
</body>
</html>
