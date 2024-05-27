<?php
include_once '../conn/conn.php';

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    //check if email exists
    $query = $pdo->prepare("SELECT * FROM users WHERE email = ? AND id != ?");
    $query->execute([$email, $user['user_id']]);

    $email_taken = $query->rowCount() > 0;

    //check if phone exists
    $query = $pdo->prepare("SELECT * FROM students WHERE phone = ? AND id != ?");
    $query->execute([$phone, $user['id']]);

    $phone_taken = $query->rowCount() > 0;

    if ($email_taken || $phone_taken) {
        if ($email_taken) {
            $error['email'] = "Sorry this email is already taken!";
        }
        if ($phone_taken) {
            $error['phone'] = "Sorry this phone is already taken!";
        }
    } else {
        $query = $pdo->prepare('UPDATE students set firstname=?,lastname=?,phone=?,address=? WHERE id = ?');
        $query->execute([$firstname, $lastname, $phone,$address, $user['id']]);

        $query = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
        $query->execute([$user['email'],$user['user_id']]);

        Session::redirectTo('manage-profile.php');
        exit;
    }
}
