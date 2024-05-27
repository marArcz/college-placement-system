<?php
if (isset($_POST['submit'])) {
    $curent_pass = $_POST['current_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];

    if ($new_pass != $confirm_pass) {
        $error['new_pass'] = 'Passwords does not match!';
    }

    if (password_verify($curent_pass, $user['password']) && !isset($error['new_pass'])) {
        $hashed_pass = password_hash($new_pass, PASSWORD_BCRYPT);

        $query = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        $query->execute([$hashed_pass, $user['user_id']]);
        Session::insertSuccess("Successfully changed password!");
        Session::redirectTo('profile.php');
        exit;

    } else {
        $error['current_pass'] = 'You entered an incorrect password!';
    }
}
