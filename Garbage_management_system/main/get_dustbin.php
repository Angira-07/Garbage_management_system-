<?php
include '../main/db_connect.php'; // adjust path if needed

// Fetch delivered dustbins with valid coordinates
$sql = "SELECT id, latitude, longitude FROM `orders` 
        WHERE order_status = 'Delivered' AND latitude IS NOT NULL AND longitude IS NOT NULL";
        
$result = $conn->query($sql);

$dustbins = [];

while ($row = $result->fetch_assoc()) {
    $dustbins[] = $row;
}

header('Content-Type: application/json');
echo json_encode($dustbins);
?>
