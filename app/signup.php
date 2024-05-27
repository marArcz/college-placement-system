<?php
include_once '../conn/conn.php';
include_once '../includes/session.php';

if (isset($_POST['signup'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_pass = $_POST['confirm_pass'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];
    $address = $_POST['address'];
    $graduation_year = $_POST['graduation_year'];

    // check if email already used
    $query = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $query->execute([$email]);

    if ($query->rowCount() > 0) {
        $error['email'] = "Sorry this email already taken!";
    } else {
        if ($password == $confirm_pass) {
            // insert user account
            $stmt = $pdo->prepare("INSERT INTO users(email,password,user_type) VALUES(?,?,'student')");
            $stmt->execute([$email, password_hash($password, PASSWORD_BCRYPT)]);
            $user_id = $pdo->lastInsertId();

            // insert student
            $stmt = $pdo->prepare("INSERT INTO students(firstname,lastname,phone,user_id,graduation_year,course,address) VALUES(?,?,?,?,?,?,?)");
            $stmt->execute([$firstname,$lastname,$phone,$user_id,$graduation_year,$course,$address]);
            Session::saveUserSession($user_id);
            Session::redirectTo('manage-profile.php');
            exit;

        }else{
            $error['password'] = "Passwords does not match!";
        }
    }
}
