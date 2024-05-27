<?php 
include_once '../conn/conn.php';

if(isset($_POST['submit'])){
    $job_title = $_POST['job_title'];
    $company = $_POST['company'];
    $month_from = $_POST['month_from'];
    $month_to = $_POST['month_to'];
    $year_from = $_POST['year_from'];
    $year_to = $_POST['year_to'];
    $current_job = isset($_POST['current_job']);

    $query = $pdo->prepare('UPDATE experiences SET job_title=?,company=?,month_from=?,month_to=?,year_from=?,year_to=?,is_current_job=? WHERE id = ?');
    $added = $query->execute([$job_title,$company,$month_from,$month_to,$year_from,$year_to,$current_job,$_GET['id']]);

    if($added){
        Session::insertSuccess("Successfully updated work experience!");
        Session::redirectTo('manage-profile.php');
        exit;
    }else{
        Session::insertError();
        Session::redirectTo('manage-profile.php');
        exit;
    }
}

?>