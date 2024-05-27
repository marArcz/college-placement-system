<?php
include_once '../conn/conn.php';
include '../includes/session.php';

$id = $_GET['id'];

$query = $pdo->prepare("DELETE FROM skills WHERE id = ?");
$query->execute([$id]);

Session::insertSuccess('Successfully deleted skill!');
Session::redirectTo('manage-profile.php');
