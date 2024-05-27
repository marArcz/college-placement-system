<?php 
include_once '../../conn/conn.php';
include_once '../includes/session.php';

$id = $_GET['id'];
$status = $_GET['status'];

$query = $pdo->prepare("UPDATE interviews SET status = ? WHERE id = ?");
$query->execute([$status,$id]);

Session::redirectTo('../views/interviews.php');

?>