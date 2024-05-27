<?php 
include_once '../conn/conn.php';

if(isset($_POST['submit'])){
    $level = $_POST['level'];
    $school = $_POST['school'];
    $year_from = $_POST['year_from'];
    $year_to = $_POST['year_to'];
    $currently_enrolled = isset($_POST['currently_enrolled']);

    $query = $pdo->prepare('UPDATE educations SET level=?,school=?,year_from=?,year_to=?,currently_enrolled=? WHERE id = ?');
    $added = $query->execute([$level,$school,$year_from,$year_to,$currently_enrolled,$_GET['id']]);

    if($added){
        Session::insertSuccess("Successfully updated education record!");
        Session::redirectTo('manage-profile.php');
        exit;
    }else{
        Session::insertError();
        Session::redirectTo('manage-profile.php');
        exit;
    }
}

?>