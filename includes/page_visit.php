<?php
include_once '../conn/conn.php';

// Get visitor's IP address
$ip_address = $_SERVER['REMOTE_ADDR'];

// Get current date (year-month-day format)
$visit_date = date("Y-m-d");

// Check if a record exists for today's date and IP address (optional)
$sql_check = "SELECT * FROM page_visits WHERE visit_date = :visit_date AND ip_address = :ip_address";
$stmt = $pdo->prepare($sql_check);
$stmt->bindParam(":visit_date", $visit_date);
$stmt->bindParam(":ip_address", $ip_address);
$stmt->execute();

// If record doesn't exist or check is disabled, insert a new visit record
if ($stmt->rowCount() === 0) {
    $sql = "INSERT INTO page_visits (visit_date, ip_address) VALUES (:visit_date, :ip_address)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":visit_date", $visit_date);
    $stmt->bindParam(":ip_address", $ip_address);
    $stmt->execute();
}
