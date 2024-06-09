<?php
    //start of session

    session_start();
    //logout(ed) users shouldn't have access to the dashboard, redirect to login page
    if(!isset($_SESSION['user'])) header('location: login.php');
    $_SESSION['table'] = 'users';
    $user = $_SESSION['user'];
    $users = include('database/show.php');

?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IMS: VIEW USERS</title>

    
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
                        <h2 class="AddUserHeader"><i class = "fas fa-list-ul"></i> List of Added Users</h2>
                        <div class="AddUserContent">
                            <div class="Users">
                                <table style="
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
                                        <th>System ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $index =>$user) { ?>
                                         <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td class="name"><?= $user['name'] ?></td>
                                            <td class="email"><?= $user['email'] ?></td>
                                            <td><?= $user['created_at'] ?></td>
                                            <td><?= $user['updated_at'] ?></td>
                                            <td class="action">
                                                <div class = "updateUser">
                                                    <a href="" class="updateUser" data-userid="<?= $user['ID'] ?>"> <i class="fas fa-pencil-alt"></i> Edit</a></div>
                                                <div class="deleteUser"> 
                                                    <a href="" class="deleteUser" 
                                                    data-userid="<?= $user['ID'] ?>"
                                                    data-nname="<?= $user['name']?>" 
                                                    data-ename="<?= $user['email']?>" 
                                                    > 
                                                    <i class="fas fa-trash"> </i> Delete </a></div>   
                                               
                                            </td>
                                        </tr>
                                        <?php } ?>   

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
         

    </div>
</div>
<?php include('partials/app-scripts.php'); ?>

<script>
    function script () {
        this.initialize = function(){
            this.registerEvents();
        }
        this.registerEvents = function(){
            document.addEventListener('click', function(e){
                targetElement = e.target;
                classList =  targetElement.classList;


                if(classList.contains('deleteUser')){
                    e.preventDefault();
                    var userId = targetElement.dataset.userid; // Define userId variable
                    var nname = targetElement.dataset.nname;
                    var ename = targetElement.dataset.ename;
                    BootstrapDialog.confirm({
                        type:BootstrapDialog.TYPE_DANGER,
                        title: 'Delete User',
                        message: 'Confirm to delete: <strong>'+ nname+'</strong>',
                        callback:function(isDelete){
                        if(isDelete){
                                $.ajax({
                                method:'POST',
                                data: {
                                    id:userId,
                                    table: 'users'
                                    
                                },
                                url:'database/delete.php',
                                dataType:'json',
                                success:function(data){
                                    message = data.success ?
                                    nname + ' is sucessfully deleted.' : 'Error processing your request.';

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
                if(classList.contains('updateUser')){
                    e.preventDefault();
                    //to get the data
                    var userId = targetElement.dataset.userid;
                    var name = targetElement.closest('tr').querySelector('td.name').innerHTML;
                    var email= targetElement.closest('tr').querySelector('td.email').innerHTML;

                    BootstrapDialog.confirm({
                        title:'Updating user ' + name,
                        message: '<form>\
                        <div class ="form-group">\
                            <label for ="name"> Name: </label>\
                            <input type = "text" class = "form-control" id = "nameUpdate" value="'+name +'">\
                            </div>\
                        <div class ="form-group">\
                            <label for ="email"> Email Address: </label>\
                            <input type = "emailUpdate" class = "form-control" id = "emailUpdate" value="'+email +'">\
                            </div>\ </form>',
                            callback: function(isUpdate){
                                if(isUpdate){ //when user hit the ok button on the confirm console
                                    $.ajax({
                                        method:'POST',
                                        data: {
                                            user_id:userId,
                                            n_name:document.getElementById('nameUpdate').value,
                                            e_name:document.getElementById('emailUpdate').value
                                        },
                                        url:'database/update-user.php',
                                        dataType:'json',
                                        success:function(data){
                                            if(data.success){
                                                BootstrapDialog.alert({
                                                    type: BootstrapDialog.TYPE_SUCCESS,
                                                    message:data.message,
                                                    callback:function(){
                                                        location.reload();
                                                    }
                                                });
                        
                                            }else 
                                            BootstrapDialog.alert({
                                                type: BootstrapDialog.TYPE_DANGER,
                                                message:data.message,
                                            });
                                                
                                        }
                                        
                                    })

                                }
                            }
                    })
                }
            });

        }
        
    }
    var script = new script;
    script.initialize();
</script>
</body>
</html>
