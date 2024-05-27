<?php 
include_once '../conn/conn.php';

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $years_exp = $_POST['years_exp'];

    $query = $pdo->prepare("INSERT INTO skills(name,years_exp,resume_id) VALUES(?,?,?)");
    $query->execute([$name,$years_exp,$_GET['id']]);

    Session::insertSuccess('Successfully added a skill');
    Session::redirectTo('manage-profile.php');

    exit;
}

?>