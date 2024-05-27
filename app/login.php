<?php
include_once '../conn/conn.php';
include_once '../includes/session.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $pdo->prepare("SELECT * FROM users WHERE email = ? AND user_type = ?");
    $query->execute([$email, 'student']);
    $user = $query->fetch();

    if ($user) {
        if (password_verify($password, $user['password'])) {
            Session::saveUserSession($user['id']);

            $student = Session::getUser($pdo);

            // check if student have not yet created a resume
            $query = $pdo->prepare("SELECT * FROM resumes WHERE student_id = ?");
            $query->execute([$student['id']]);
            $has_resume = $query->rowCount() > 0;
            $resume_complete = false;

            if ($has_resume) {
                $resume = $query->fetch();
                $query = $pdo->prepare("SELECT * FROM resume_summaries WHERE resume_id = ?");
                $query->execute([$resume['id']]);
                $has_summary = $query->rowCount() > 0;

                $query = $pdo->prepare("SELECT * FROM experiences WHERE resume_id = ?");
                $query->execute([$resume['id']]);
                $has_experiences = $query->rowCount() > 0;

                $query = $pdo->prepare("SELECT * FROM educations WHERE resume_id = ?");
                $query->execute([$resume['id']]);
                $has_educations = $query->rowCount() > 0;

                $resume_complete = $has_summary && $has_summary && $has_educations;
            }

            if ($resume_complete) {
                Session::redirectTo('home.php');
            } else {
                Session::redirectTo('manage-profile.php');
            }

            exit;
        } else {
            $error['password'] = 'You entered an incorrect password!';
        }
    } else {
        $error['email'] = 'Your credentials does not match any of our records!';
    }
}
