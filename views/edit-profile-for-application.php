<?php
include '../includes/session.php';
if (isset($_GET['id'])) {

    Session::insertSession('job_id', $_GET['id']);
    Session::redirectTo('manage-profile.php');
    exit;
}

Session::redirectTo('jobs.php');
