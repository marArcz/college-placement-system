<?php 
include '../conn/conn.php';
include '../includes/session.php';

$id = $_GET['id'];

$query = $pdo->prepare("DELETE FROM experiences WHERE id =?");
$query->execute([$id]);

Session::insertSuccess('Successfully deleted work experience!');
Session::redirectTo('manage-profile.php');

?>