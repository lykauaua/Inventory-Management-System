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
    <title>IMS:REPORTS</title>
    <?php include('partials/app-header-scripts.php'); ?>
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
            <div class="reportsContainer" style="display: flex; justify-content: center;">
                    <div class="reportTypeContainer">
                        <div class="reportTypeReport">
                            <p style="font-weight: bold; margin-top: 10px;">Inventory of Equipment Report</p>
                            <div style="text-align: right;">
                                <a href="database/report_csv.php?report=equipment" class="reportExportBtn">Excel</a>
                                <a href="database/report_pdf.php?report=equipment" class="reportExportBtn">PDF</a>
                            </div>
                        </div>
                        <div class="reportTypeReport">
                            <p style="font-weight: bold; margin-top: 10px;">Inventory of Tools Report</p>
                            <div style="text-align: right;">
                                <a href="database/report_csv.php?report=tools" class="reportExportBtn">Excel</a>
                                <a href="database/report_pdf.php?report=tools" class="reportExportBtn">PDF</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="reportsContainer" style="display: flex; justify-content: center;">
                    <div class="reportTypeContainer">
                        <div class="reportTypeReport">
                            <p style="font-weight: bold; margin-top: 10px;">Inventory of Consumables Report</p>
                            <div style="text-align: right; margin-top: -18px">
                                <a href="database/report_csv.php?report=consumables" class="reportExportBtn">Excel</a>
                                <a href="database/report_pdf.php?report=consumables" class="reportExportBtn">PDF</a>
                            </div>
                        </div>
                        <div class="reportTypeReport all_storageReport">
                            <p style="font-weight: bold; margin-top: 10px;">CSR Over-All Storage Report</p>
                            <div style="text-align: right; ;">
                                <a href="database/report_csv.php?report=all_storage" class="reportExportBtn">Excel</a>
                                <a href="database/report_pdf.php?report=all_storage" class="reportExportBtn">PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
    </div>

</div>
<?php include('partials/app-scripts.php'); ?>
</script>
</body>
</html>
