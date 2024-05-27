<?php 
include_once '../../conn/conn.php';

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $job_type = $_POST['job_type'];
    $salary_range = $_POST['salary_range'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];

    $query = $pdo->prepare("INSERT INTO jobs(title,company,location,job_type,salary_range,description,deadline) VALUES(?,?,?,?,?,?,?)");
    $query->execute([$title,$company,$location,$job_type,$salary_range,$description,$deadline]);

    Session::insertSuccess("Successfully posted a job!");
    Session::redirectTo('jobs.php');
    exit;
}

?>