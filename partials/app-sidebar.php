<?php
$user = $_SESSION['user'];
?>
<div class="sidebar" id="sidebar">
        <div class="logo" id="logo">
            <img src="pics/cdm_logo.png" alt = "cdm logo" id="cdm_logo">
        </div> 
        <div class="sidebar-user" id = "sidebar_user">
            <p id = "sidebar_user_p"> Welcome, <?= $user['name'] ?>!</p>
        </div>
        <div class="sidebar-menu"></div>
        <ul class="menu-lists">
           <!--  class="whenActive" -->
            <li class="liMainMenu">
                <a href="javascript:void(0);" class="showHideSubMenu"><i class="fas fa-toolbox showHideSubMenu" ></i><span class = "menuText showHideSubMenu" > Storage</span>
                    <i class="fas fa-angle-up menuArrowIcon showHideSubMenu" ></i></a> 

                <ul class = "subMenus" id="user" style=" list-style-type: none;">
                    <li class="liSubMenu"><a href="./view-list.php"><i class = "fas fa-eye"></i><span class = "menuText">View All</span></a></li>
                    <li class="liSubMenu"><a href="./view.php"><i class = "fas fa-cog"></i><span class = "menuText">Add and Edit</span></a></li>

                </ul>
            </li>

            <li class="liMainMenu showHideSubMenu" >
                <a href="./report.php" style="padding: 10px 10px;"><i class="fas fa-pencil-alt"></i><span class = "menuText"> Report</span></a>
            </li>


            <li class="liMainMenu showHideSubMenu">
                <a href="javascript:void(0);" class="showHideSubMenu"><i class="fas fa-user showHideSubMenu" ></i><span class = "menuText showHideSubMenu" > Manage User</span>
                    <i class="fas fa-angle-up menuArrowIcon showHideSubMenu" ></i></a> 

                <ul class = "subMenus" id="user" style=" list-style-type: none;">
                    <li class="liSubMenu"><a href="./users-view.php"><i class = "fas fa-eye"></i><span class = "menuText">View Users</span> </a></li>
                    <li class="liSubMenu"><a href="./users-add.php"><i class = "fas fa-user-plus"></i> <span class = "menuText">Add Users</span> </a>
                    </li>
                </ul>
            </li>
        </ul>
        
</div>