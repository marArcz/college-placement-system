<?php 
include '../../conn/conn.php';
include '../includes/session.php';

if(isset($_GET['id'])){
    $query = $pdo->prepare("UPDATE job_applications SET status = ? WHERE id = ?");
    $query->execute([$_GET['status'],$_GET['id']]);

    $query = $pdo->prepare("SELECT * FROM jobs WHERE id IN (SELECT job_id FROM job_applications WHERE id = ?)");
    $query->execute([$_GET['id']]);
    $job = $query->fetch();

    Session::redirectTo('manage-job.php?id='.$job['id']);
    exit;
}

Session::redirectTo('jobs.php');

?>