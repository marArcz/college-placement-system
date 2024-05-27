<?php 
include '../conn/conn.php';
include '../includes/session.php';

if(isset($_GET['id'])){
    $query = $pdo->prepare("DELETE FROM job_applications WHERE id = ?");
    $query->execute([$_GET['id']]);

    Session::insertSuccess("We successfully withdrawn your application!");
    Session::redirectTo("applications.php");
}
?>