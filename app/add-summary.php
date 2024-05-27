<?php 
include_once '../conn/conn.php';

if(isset($_POST['submit'])){
    $summary = $_POST['summary'];
    $resume_id = $_GET['r'];

    $query = $pdo->prepare("INSERT INTO resume_summaries(summary,resume_id) VALUES(?,?)");
    $query->execute([$summary,$resume_id]);

    Session::insertSuccess('Successfully added a summary!');
    Session::redirectTo("manage-profile.php");
    exit;
}

?>