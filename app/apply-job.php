<?php 
include_once '../conn/conn.php';

if(isset($_POST['submit'])){
    $job_id = $_GET['id'];
    $user_id = $user['id'];

    $query = $pdo->prepare("INSERT INTO job_applications(job_id,student_id) VALUES(?,?)");
    $query->execute([$job_id,$user_id]);

    Session::insertSuccess('Successfully submitted job application!');
    Session::redirectTo('submitted-application.php?id='.$job_id);
}
?>