<?php 
include_once '../../conn/conn.php';
include '../includes/session.php';

Session::destroyUserSession();
Session::redirectTo("index.php");

exit;

?>