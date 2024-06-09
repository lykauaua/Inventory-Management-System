<!-- FOR VIEWING INVENTORY FOR consumables -->
<?php
    //start of session

    session_start();
    //logout(ed) users shouldn't have access to the dashboard, redirect to login page
    if(!isset($_SESSION['user'])) header('location: login.php');
    $_SESSION['table'] = 'consumables';
    $consumables = include('database/show.php');

?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IMS: VIEW CONSUMABLES</title>

    
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
                        <h2 class="AddUserHeader"><i class = "fas fa-list-ul"></i> Consumables List </h2>
                         
                        <div class="AddUserContent">
                            <div class="Users">

                                <table id = "consumeTable" style="
                                border: 1px solid #9f9e85 ;
                                padding: 3px ;
                                margin-top: 25px ;
                                font-family: monospace ;
                                border-collapse: separate; 
                                border-spacing: 2px; 
                                text-align: center; 
                                width: 100%;">
                               
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
                                        <th>Action</th>
                                        </tr>

                                    </thead>
                                    <tbody> 

                                        <?php foreach ($consumables as $index =>$consumable) { ?>
                                         <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td class="serial_num"><?= $consumable['serial_num'] ?></td>
                                            <td class="img">
                                                <img class="equip_img" src="uploads/consumables/<?= $consumable['img']?>" >
                                            </td>
                                            <td class="equip_name"><?= $consumable['equip_name'] ?></td>
                                            <td class="quantity"><?= $consumable['quantity'] ?></td>
                                            <td class="brand_model"><?= $consumable['brand_model'] ?></td>
                                             <td>
                                                 <?php 
                                                    $equipId = $consumable['created_by'];
                                                    $stmt = $conn->prepare("SELECT * FROM users WHERE id =  $equipId");
                                                    if ($stmt->execute()) {
                                                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                                        if ($row) {
                                                            $created_by_name = $row['name'];
                                                            echo $created_by_name;
                                                        } else {
                                                            echo "User Not Found"; 
                                                        }
                                                    } else {
                                                        echo "User Not Found"; 
                                                    }
                                                ?>

                                             </td>
                                            <td class= "location" style="font-weight: bold;"><?= $consumable['location'] ?></td>
                                            <td class="remarks">
                                                <?php if ($consumable['remarks'] == 'No Remarks'): ?>
                                                    <span class="status-green" ><?= htmlspecialchars($consumable['remarks']) ?></span>
                                                <?php else: ?>
                                                    <span class="status-orange"><?= htmlspecialchars($consumable['remarks']) ?></span>
                                                <?php endif; ?>
                                            </td>

                                            <td class="status">
                                            <?php if ($consumable['status'] == 'Available'): ?>
                                                <span class="status-green"><?= $consumable['status'] ?></span>
                                            <?php elseif ($consumable['status'] == 'Unavailable'): ?>
                                                <span class="status-orange"><?= $consumable['status'] ?></span>
                                            <?php elseif ($consumable['status'] == 'Expired'): ?>
                                                <span class="status-orange"><?= $consumable['status'] ?></span>                                                
                                            <?php else: ?>
                                                <?= $consumable['status'] ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $consumable['maintenance'] ?></td>


                                            <td class="action">
                                                <div class = "updateUser">
                                                    <a href="" class="updateEquip" data-equipid="<?= $consumable['ID'] ?>" data-serialnum="<?= $consumable['serial_num'] ?>"> <i class="fas fa-pencil-alt"></i> Edit</a></div>
                                                <div class="deleteUser"> 
                                                    <a href="" class="deleteEquip" data-equipname="<?= $consumable['equip_name'] ?>" data-equipid="<?= $consumable['ID'] ?>" > 
                                                    <i class="fas fa-trash"> </i> Delete </a></div>
                                                
                                                    <button type="submit" class="moreInfoBtn" style="border-color:#a8c7fa; color:#8781c6; margin-top: 7px;" 
                                                    onclick="openPopup()">More Info</button>
                                                    <?php include('partials/moreInfoC.php')?>
    
                                            </td>
                                        </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                                <p class = "equip_count"><?= count($consumables) ?> items </p>
                                
                            </div>
                            <div class="legend">
                                <img src="pics/legend.png" alt="legend.png">
                            </div>
                            <div class="credits" id="credits">
                            <p>Colegio de Muntinlupa | © 2024 | CPE2 - Software Design ~ All rights reserved.</p> 
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
    $('#consumeTable').DataTable();
  });
</script>
<script>
   function script () {
    var vm = this;
        
        this.registerEvents = function(){
            document.addEventListener('click', function(e){

                targetElement = e.target;
                classList =  targetElement.classList;
                console.log(classList);


                if(classList.contains('deleteEquip')){
                    e.preventDefault(); // prevents the default mechanism

                    var equipId = targetElement.dataset.equipid;
                    var equipName = targetElement.dataset.equipname;

                       BootstrapDialog.confirm({
                        type:BootstrapDialog.TYPE_DANGER,
                        title: 'Delete Consumables',
                        message: 'Confirm to delete <strong>'+ equipName + '</strong>',
                        callback:function(isDelete){
                            if(isDelete){
                                $.ajax({
                                method:'POST',
                                data: {
                                    id:equipId,
                                    table: 'consumables'
                                    
                                },
                                url:'database/delete.php',
                                dataType:'json',
                                success:function(data){
                                    message = data.success ? 
                                    equipName + '<strong></strong> is sucessfully deleted.' : 'Error processing your request.';

                                     BootstrapDialog.alert({
                                        type:data.success ? BootstrapDialog.TYPE_SUCCESS : BootstrapDialog.TYPE_DANGER,
                                        message:message,
                                        callback:function(){
                                            if(data.success) location.reload();
                                        
                                        }
                                     });


                                }
                                
                            }); 
                            }
                        }
                    });
                }
                if(classList.contains('updateEquip')){
                    e.preventDefault(); // prevents the default mechanism

                    equipId = targetElement.dataset.equipid;
                    serialNum = targetElement.dataset.serialnum;
                    console.log(equipId,serialNum);
                    vm.showEditDialog(equipId);
                }


            });

            document.addEventListener('submit',function(e){
                targetElement = e.target;
                
                e.preventDefault();
                if(targetElement.id === 'editEquipForm'){
                    vm.saveUpdateData(targetElement);
                }

            });
        },
        this.saveUpdateData = function(form){
            
                $.ajax({
                    method:'POST',
                    data: new FormData(form),
                    dataType: 'json',
                    url:'database/update-consumables.php', 
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success:function(data){
                        
                        BootstrapDialog.alert({
                            type: data.success?BootstrapDialog.TYPE_SUCCESS:BootstrapDialog.TYPE_DANGER,
                            message: data.message,
                            callback:function(){
                                if(data.success) location.reload();
                            }
                        });
                            
                    }
                    
                })
        }
        this.showEditDialog = function(ID){

            $.get('database/get-consumables.php', {ID: ID}, function(consumablesDetails) {
                console.log(consumablesDetails);

       BootstrapDialog.confirm({
                title:'Updating Equipment: <strong>'+ consumablesDetails.equip_name +'</strong>',

                message:  '<form  action="database/addC.php" method="POST"enctype = "multipart/form-data" id="editEquipForm">\
                            <div class="appFormInputContainer">\
                                <label for="serial_num" class="appFormAtt" >Serial No.</label>\
                                <input type="number" id="serial_num" name="serial_num" placeholder="Enter the serial no. of the Consumables.." class="appFormInput" value="'+ consumablesDetails.serial_num +'">\
                            </div>\
                            <div class="appFormInputContainer">\
                                <label for="equip_name" class="appFormAtt" >Consumables Name</label>\
                                <input type="text" id="equip_name" name="equip_name" placeholder="Enter Consumables name.. eg. Filter Paper " class="appFormInput" value="'+ consumablesDetails.equip_name +'">\
                            </div>\
                            <div class="appFormInputContainer">\
                                <label for="quantity" class="appFormAtt" >Quantity</label>\
                                <input type="number" id="quantity" name="quantity" placeholder="Enter the quantity of the consumables" class="appFormInput" value="'+ consumablesDetails.quantity +'">\
                            </div>\
                            <div class="appFormInputContainer">\
                                <label for="status" class="appFormAtt" >Status</label>\
                                <select class="dropDownStatus" name="status" id="status">\
                                <option selected disabled>Choose a status</option>\
                                <option style="padding: 4px 4px; background: lightgreen;"\
                                '+ (consumablesDetails.status == "Available" ? "selected" : "") +'>Available</option>\
                                <option style="padding: 4px 4px; background: orange;"\
                                '+ (consumablesDetails.status == "Unavailable" ? "selected" : "") +'>Unavailable</option>\
                                <option style="padding: 4px 4px; background: orange;"\
                                '+ (consumablesDetails.status == "Expired" ? "selected" : "") +'>Expired</option>\
                            </select>\
                            <input type="hidden" name="prev_status" value="'+ consumablesDetails.status +'">\
                                </div>\
                           <div class="appFormInputContainer">\
                            <label for="remarks" class="appFormAtt">Remarks</label>\
                            <select id="remarksSelect" name="remarksSelect" class="appFormInputRe" onchange="toggleRemarksInput()" style="margin-right: 10px;">\
                            <option value="input" style="padding: 4px 4px; background: orange;">Add remarks</option>\
                                <option value="noRemarks" style="padding: 4px 4px; background: lightgreen;">No Remarks</option>\
                            </select>\
                            <input type="text" id="remarksInput" name="remarksInput" placeholder="Add remarks" class="appFormInputRe" required style="display: inline;" value="'+ consumablesDetails.remarks +'"/>\
                            \
                        </div>\
                            <div class="appFormInputContainer">\
                                <label for="maintenance" class="appFormAtt" >Maintenance Date:</label>\
                                <input type="datetime-local" name="maintenance" class="form-control appFormInput" placeholder="Select date" value="'+ consumablesDetails.maintenance +'">\
                            </div>\
                            <div class="appFormInputContainer">\
                                <label for="brand_model" class="appFormAtt" >Brand Model</label>\
                                <input type="text" id="brand_model" name="brand_model" class="appFormInput" style="width:30%;" placeholder=" brandX-1234" value="'+ consumablesDetails.brand_model +'">\
                                <label for="location" class="appFormAtt" >location</label>\
                                <input type="text" id="location" name="location" placeholder="Eg. CpE Lab" class="appFormInput"style="width:30%;" value="'+ consumablesDetails.location +'">\
                            </div>\
                               <div class="appFormInputContainer" id="img">\
                                <label for="img" class="appFormAtt" >Consumables Image</label>\
                                <input type="file" name="img" id="editEquipImg" required>\
                                <input type="hidden" name="prev_img" value="'+ consumablesDetails.img +'" required>\
                            </div>\
                            <input type = "hidden" name ="equipid" value = "'+consumablesDetails.ID +'" >\
                        <input type = "submit" value = "submit" id="editEquipSubmitBtn" class="hidden">\
                           </form>\
                    ',
                    callback: function(isUpdate){
                                if(isUpdate){ // When user hits the ok button on the confirm console
                                    var imgInput = document.getElementById('editEquipImg');
                                    if(imgInput.files.length === 0) {
                                        // If image input is empty, show an alert and prevent passing
                                        BootstrapDialog.alert({
                                            type: BootstrapDialog.TYPE_DANGER,
                                            message: "Please select an image.",
                                            callback: function(){
                                                // Close the DANGER dialog and return to the update form
                                                return; // Prevent the dialog from closing
                                            }
                                        });
                                        return false; // Prevent passing
                                    } else {
                                        // If image input is not empty, proceed with form submission
                                        document.getElementById('editEquipSubmitBtn').click();
                                    }
                                }
                            }
                        });



                
            },'json'); 
                           
        }


        this.initialize = function(){
            this.registerEvents();
        }
    }
        
    var script = new script;
    script.initialize();
</script>

</body>
</html>
