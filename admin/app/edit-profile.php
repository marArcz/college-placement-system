<?php 
if(isset($_POST['submit'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];

    $query = $pdo->prepare("UPDATE admins SET firstname=?,lastname=? WHERE id = ?");
    $query->execute([$firstname,$lastname, $user['id']]);

    $query = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
    $query->execute([$email,$user['user_id']]);
    Session::insertSuccess("Successfully updated profile!");
    Session::redirectTo('profile.php');
    exit;
}

?>