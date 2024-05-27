<?php
include_once '../conn/conn.php';

if (isset($_POST['submit'])) {
    $citizenship = $_POST['citizenship'];
    $civil_status = $_POST['civil_status'];

    $query = $pdo->prepare("INSERT INTO personal_infos(citizenship, civil_status,resume_id) VALUES(?,?,?)");
    $query->execute([$citizenship, $civil_status,$_GET['id']]);

    Session::insertSuccess('Successfully added personal info!');
    Session::redirectTo("manage-profile.php");
    exit;
}
