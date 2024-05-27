<?php 
include_once '../conn/conn.php';

if(isset($_POST['submit'])){
    $summary = $_POST['summary'];
    $summary_id = $_GET['s'];

    $query = $pdo->prepare("UPDATE resume_summaries SET summary = ? WHERE id = ?");
    $query->execute([$summary,$summary_id]);

    Session::insertSuccess('Successfully updated summary!');
    Session::redirectTo("manage-profile.php");
    exit;
}

?>