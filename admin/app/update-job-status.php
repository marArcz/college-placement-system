<?php 
include '../../conn/conn.php';
include '../includes/session.php';

if(isset($_GET['id'])){
    $query = $pdo->prepare("UPDATE jobs SET status = ? WHERE id = ?");
    $query->execute([$_GET['status'],$_GET['id']]);

    Session::redirectTo('manage-job.php?id='.$_GET['id']);
    exit;
}

Session::redirectTo('jobs.php');
?>