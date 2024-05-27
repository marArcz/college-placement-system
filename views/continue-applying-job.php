<?php 
include '../includes/session.php';

if(Session::hasSession('job_id')){
    $job_id = Session::getSession('job_id');
    Session::redirectTo('apply-job.php?id='.$job_id.'#profile');
    exit;
}

Session::redirectTo('jobs.php');

?>