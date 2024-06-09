<?php
    $type = $_GET['report'];

    // Define file names for equipment, tools, and all_storage reports
    $mapping_filenames = [
        'equipment' => 'Equipment_Report.xls',
        'tools' => 'Tools_Report.xls',
        'consumables' => 'Consumables_Report.xls',
        'all_storage' => 'All_Storage_Report.xls'
    ];

    // Check if the requested report type is valid
    if (!isset($mapping_filenames[$type])) {
        exit("Invalid report type.");
    }

    $file_name = $mapping_filenames[$type];

    header("Content-Disposition: attachment; filename=\"$file_name\"");
    header("Content-Type: application/vnd.ms-excel");

    // Pull data from the database
    include('connection.php');

    // Fetch data based on the report type
    if ($type === 'equipment') {
        $stmt = $conn->prepare("SELECT *, 'equipment' as source FROM equipment INNER JOIN users ON equipment.created_by = users.ID ORDER BY equipment.created_at DESC");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $data = $stmt->fetchAll();
    } elseif ($type === 'tools') {
        $stmt = $conn->prepare("SELECT *, 'tools' as source FROM tools INNER JOIN users ON tools.created_by = users.ID ORDER BY tools.created_at DESC");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $data = $stmt->fetchAll();
    } elseif ($type === 'consumables') {
        $stmt = $conn->prepare("SELECT *, 'consumables' as source FROM consumables INNER JOIN users ON consumables.created_by = users.ID ORDER BY consumables.created_at DESC");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $data = $stmt->fetchAll();
    } elseif ($type === 'all_storage') {
        // Fetch data for all_storage by combining equipment and tools data
        $stmt = $conn->prepare("
            SELECT 'equipment' as source, equipment.ID as equip_id, equip_name, brand_model, img, quantity,location,remarks, equipment.created_at as created_at, equipment.created_by as created_by, equipment.updated_at as updated_at, status, serial_num, maintenance, users.ID as user_id, users.name as name, users.email, users.password, users.created_at as user_created_at, users.updated_at as user_updated_at
            FROM equipment 
            INNER JOIN users ON equipment.created_by = users.ID
            UNION ALL

            SELECT 'tools' as source, tools.ID as equip_id, equip_name, brand_model, img, quantity,location,remarks, tools.created_at as created_at, tools.created_by as created_by, tools.updated_at as updated_at, status, serial_num, maintenance, users.ID as user_id, users.name as name, users.email, users.password, users.created_at as user_created_at, users.updated_at as user_updated_at
            FROM tools 
            INNER JOIN users ON tools.created_by = users.ID
            UNION ALL

            SELECT 'consumables' as source, consumables.ID as equip_id, equip_name, brand_model, img, quantity,location,remarks, consumables.created_at as created_at, consumables.created_by as created_by, consumables.updated_at as updated_at, status, serial_num, maintenance, users.ID as user_id, users.name as name, users.email, users.password, users.created_at as user_created_at, users.updated_at as user_updated_at
            FROM consumables 
            INNER JOIN users ON consumables.created_by = users.ID

            ");

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $data = $stmt->fetchAll();
        
    }

    // Pulling and displaying the headers for the Excel
    $is_header = true;
    foreach ($data as $row) {
        $row['created_by'] = $row['name'];
        unset($row['name'], $row['equip_id'],$row['ID'],  $row['password'], $row['email'], $row['user_id'], $row['user_created_at'], $row['user_updated_at']);
        if ($is_header) {
            // Extracting headers from the first row of data
            $headers = array_keys($row);
            echo implode("\t", $headers) . "\n";
            $is_header = false;
        }
        // Outputting data rows
        echo implode("\t", $row) . "\n";
    }
?>
