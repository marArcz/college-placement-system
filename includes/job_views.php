<?php
include_once '../conn/conn.php';

$job_id = $_GET['id'];

$sql_check = "SELECT * FROM job_views WHERE job_id = ? AND student_id=? ";
$stmt = $pdo->prepare($sql_check);
$stmt->execute([$job_id,$user['id']]);

// If record doesn't exist or check is disabled, insert a new visit record
if ($stmt->rowCount() === 0) {
    $sql = "INSERT INTO job_views(job_id,student_id) VALUES(?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$job_id,$user['id']]);
}
