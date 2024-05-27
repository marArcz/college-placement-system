<?php
include_once '../../conn/conn.php';

if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $application_id = $_GET['id'];
    $type = $_POST['type'];
    $datetime = $date . ' ' . $time;

    $query = $pdo->prepare("INSERT INTO interviews(application_id,date,type) VALUES(?,?,?)");
    $added = $query->execute([$application_id,$date,$type]);

    if($added){
        $query = $pdo->prepare('UPDATE job_applications SET status = ? WHERE id = ?');
        $query->execute(['interview_scheduled',$application_id]);

        Session::insertSuccess("Successfully added an interview!");
        Session::redirectTo("interviews.php");
    }
}
