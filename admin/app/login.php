<?php 
include_once '../../conn/conn.php';
include_once '../includes/session.php';

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $pdo->prepare("SELECT * FROM users WHERE email = ? AND user_type = ?");
    $query->execute([$email,'administrator']);
    $user = $query->fetch();

    if($user){
        if(password_verify($password,$user['password'])){
            Session::saveUserSession($user['id']);
            $admin = Session::getUser($pdo);

            Session::redirectTo('dashboard.php');

            exit;
        }else{
            $error['password'] = 'You entered an incorrect password!';
        }
    }else{
        $error['email'] = 'Your credentials does not match any of our records!';
    }
    
}

?>