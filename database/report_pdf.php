<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    function __construct() {
        parent::__construct('L');
    }

    // Function to print the table header
    function PrintTableHeader($header, $w) {
        // Colors, line width and bold font
        $this->SetFillColor(94, 128, 143);
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');

        // Header
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 6, $header[$i], 1, 0, 'C', true);
        }
        $this->Ln();

        // Color and font restoration
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
    }

    // Colored table
    function FancyTable($header, $data) {
        // Add "No." column to the header
        array_unshift($header, 'No.');

        // Adjust column widths to include the new "No." column
        $w = array(10, 20, 40, 35, 30, 32, 30, 15, 65);

        // Print the table header
        $this->PrintTableHeader($header, $w);

        // Data
        $fill = false;
        $rowCount = 1; // Initialize row count
        $rowHeight = 30; // Row height

        foreach ($data as $row) {
            // Check if a page break is needed
            if ($this->GetY() + $rowHeight > $this->PageBreakTrigger) {
                $this->AddPage();
                $this->PrintTableHeader($header, $w);
            }

            $imagePath = is_null($row[1]) || $row[1] == "" ? 'No Image' : '../uploads/' . ($row[0] === 'equipment' ? 'equipments' : $row[0]) . '/' . $row[1];

            // Insert the row number
            $this->Cell($w[0], $rowHeight, $rowCount, 'LRBT', 0, 'C', $fill);
            $rowCount++;

            // Insert cells with text
            $this->Cell($w[1], $rowHeight, $row[0], 'LRBT', 0, 'C', $fill);
            
            if (file_exists($imagePath)) {
                $xBeforeImage = $this->GetX(); // Save current X position
                $yBeforeImage = $this->GetY(); // Save current Y position

                // Create a cell with the correct width and height but no border or fill
                $this->Cell($w[2], $rowHeight, '', 0, 0, 'C', $fill);

                // Restore X and Y positions before placing the image
                $this->SetXY($xBeforeImage, $yBeforeImage);
                
                // Insert the image
                $this->Image($imagePath, $this->GetX() + 7, $this->GetY() + 2, 20, 20);

                // Move the cursor to the end of the cell
                $this->SetXY($xBeforeImage + $w[2], $yBeforeImage);
            } else {
                $this->Cell($w[2], $rowHeight, 'No Image', 'LRBT', 0, 'C', $fill);
            }

            $this->Cell($w[3], $rowHeight, $row[2], 'LRBT', 0, 'C', $fill);
            $this->Cell($w[4], $rowHeight, $row[3], 'LRBT', 0, 'C', $fill);
            $this->Cell($w[5], $rowHeight, $row[4], 'LRBT', 0, 'C', $fill);
            $this->Cell($w[6], $rowHeight, $row[5], 'LRBT', 0, 'C', $fill);
            $this->Cell($w[7], $rowHeight, $row[6], 'LRBT', 0, 'C', $fill);
            $this->Cell($w[8], $rowHeight, $row[7], 'LRBT', 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

$type = $_GET['report'];
$report_header = [
    'equipment' => 'Equipment Report',
    'tools' => 'Tools Report',
    'consumables' => 'Consumables Report',
    'all_storage' => 'CSR Storage Report'
];
include('connection.php');

// Fetch data based on the report type
if ($type === 'equipment') {
    $header = array('Source','Image','Name', 'Brand', 'Created at', 'Status','Quantity', 'Remarks',);

    $stmt = $conn->prepare("SELECT *, 'equipment' as source FROM equipment INNER JOIN users ON equipment.created_by = users.ID ORDER BY equipment.created_at DESC");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $datas = $stmt->fetchAll();
} elseif ($type === 'tools') {
    $header =  array('Source','Image','Name', 'Brand', 'Created at', 'Status','Quantity', 'Remarks',);

    $stmt = $conn->prepare("SELECT *, 'tools' as source FROM tools INNER JOIN users ON tools.created_by = users.ID ORDER BY tools.created_at DESC");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $datas = $stmt->fetchAll();

} elseif ($type === 'consumables') {
    $header =  array('Source','Image','Name', 'Brand', 'Created at', 'Status','Quantity', 'Remarks',);

    $stmt = $conn->prepare("SELECT *, 'consumables' as source FROM consumables INNER JOIN users ON consumables.created_by = users.ID ORDER BY consumables.created_at DESC");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $datas = $stmt->fetchAll();
} elseif ($type === 'all_storage') {
    $header = array('Source','Image','Name', 'Brand', 'Created at', 'Status','Quantity', 'Remarks',);

    // Fetch datas for all_storage by combining equipment and tools datas
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

    $datas = $stmt->fetchAll();
    
}

$data = [];
foreach ($datas as $rows) {
    $data[] = [
        $rows['source'],
        $rows['img'],
        $rows['equip_name'],
        $rows['brand_model'],
        $rows['created_at'],
        $rows['status'],
        $rows['quantity'],
        $rows['remarks'],
    ];
}

$pdf = new PDF();

// Add page
$pdf->AddPage();

// Add logo and header text
$pdf->Image(__DIR__ . '\pics\cdm_logo.png', 8, 5, 20);
$pdf->SetFont('Arial','',12);
$pdf->SetY(7); // Set Y position to match the logo
$pdf->SetX(30); // Set X position after the logo
$pdf->Cell(0, 5, 'Colegio De Muntinlupa', 0, 1, 'L');

// Add "Inventory Report" statement inline
$pdf->SetFont('Arial', 'B', 15);
$pdf->SetY($pdf->GetY() + 1); // Move down slightly to align inline
$pdf->SetX(30); // Set X position after the logo
$pdf->Cell(0, 5, 'Inventory Report of Equipment', 0, 1, 'L');

// Add "Central Storage Room" statement inline
$pdf->SetFont('Arial', '', 12);
$pdf->SetY($pdf->GetY() + 1); // Move down slightly to align inline
$pdf->SetX(30); // Set X position after the logo
$pdf->Cell(0, 5, 'Central Storage Room', 0, 1, 'L');

// Add Document Code
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY(7); //Set Y position to match the logo
$pdf->SetX(225); // Set X position afterr the logo
$pdf->Cell(0, 5, 'Document Code: ', 0, 1, 'L');

$pdf->SetFont('Arial', '', 10);
$pdf->SetY($pdf->GetY() + 1); //Set Y position to match the logo
$pdf->SetX(225); // Set X position afterr the logo
$pdf->Cell(0, 3, 'Effective Date: ', 0, 1, 'L');
$pdf->SetY($pdf->GetY() + 1); //Set Y position to match the logo
$pdf->SetX(225); // Set X position afterr the logo
$pdf->Cell(0, 3, 'Revision No: ', 0, 1, 'L');
$pdf->SetY($pdf->GetY() + 1); //Set Y position to match the logo
$pdf->SetX(225); // Set X position afterr the logo
$pdf->Cell(0, 3, 'Revision Date: ', 0, 1, 'L');

// Add a blank line for separation
$pdf->Ln(10);

// Print report title
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0, 6, $report_header[$type], 0, 1, 'C');

// Add another blank line after the title
$pdf->Ln(6);

// Print the table

$pdf->SetFont('Arial', '', 8);
$pdf->FancyTable($header, $data);

// Output PDF
$pdf->Output();
?>
