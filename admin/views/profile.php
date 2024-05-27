<?php require '../includes/auth.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Admin</title>
    <?php include '../includes/header.php' ?>
</head>

<body class="bg-white">
    <?php $current_page = 'profile' ?>
    <?php $header = 'Account Profile' ?>
    <?php include '../includes/navbar.php' ?>
    <main class="pt-4">
        <div class="container">
            <div class="mt-2 mb-3 col-md-7 mx-auto">
                <h2 class="mb-4">Profile</h2>
                <hr>
                <?php if(Session::hasSession('success')): ?>
                    <div class="alert alert-success">
                        <?= Session::getSuccess() ?>
                    </div>
                <?php endif ?>
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-2 fs-5 fw-semibold"><?= $user['firstname'] . ' ' . $user['lastname'] ?></p>
                        <p class="mb-1 d-flex align-items-center gap-1 text-secondary">
                            <i class="fi fi-sr-envelope d-flex"></i>
                            <span class="ms-1"><?= $user['email'] ?></span>
                        </p>
                    </div>
                    <div class="ms-auto text-end">
                        <a href="edit-profile.php" class="link-blue text-decoration-none">
                            <i class="fi fi-sr-pencil"></i>
                        </a>
                    </div>
                </div>

                <div class="mt-4">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-2 fs-5 fw-semibold">Password</p>
                            <p class="mb-1 d-flex align-items-center gap-1 text-secondary">
                                <i class="fi fi-sr-lock d-flex"></i>
                                <span class="ms-1">***********************</span>
                            </p>
                        </div>
                        <div class="ms-auto text-end">
                            <a href="edit-password.php" class="link-blue text-decoration-none">
                                <i class="fi fi-sr-pencil"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include '../includes/scripts.php' ?>
    <script>
        $(function() {
            let table = new DataTable('#table');
        })
    </script>
</body>

</html>