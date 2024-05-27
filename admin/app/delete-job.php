<?php 
include '../../conn/conn.php';
include '../includes/session.php';

$query = $pdo->prepare("DELETE FROM jobs WHERE id = ?");
$query->execute([$_GET['id']]);

Session::insertSuccess('Successfully deleted job!');
Session::redirectTo('jobs.php');

?>