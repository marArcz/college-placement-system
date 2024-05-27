<?php 
include_once '../conn/conn.php';

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $years_exp = $_POST['years_exp'];

    $query = $pdo->prepare("UPDATE skills SET name=?,years_exp=? WHERE id =?");
    $query->execute([$name,$years_exp,$_GET['id']]);

    Session::insertSuccess('Successfully updated skill');
    Session::redirectTo('manage-profile.php');

    exit;
}

?>