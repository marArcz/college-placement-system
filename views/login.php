<?php include '../app/login.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Placement System Login</title>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/styles/css/custom.css">
    <link rel="stylesheet" href="../assets/styles/css/typography.css">
    <link rel="stylesheet" href="../assets/styles/css/login.css">
    <link rel="stylesheet" href="../assets/styles/css/global.css">
    <link rel="stylesheet" href="../node_modules/@flaticon/flaticon-uicons/css/all/all.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row h-100">
            <div class="col-md-6 left-side">
                <a href="index.php" class="link-dark text-decoration-none">
                    <div class="text-center">
                        <img src="../assets/images/login-logo.png" class="img-fluid" alt="">
                        <h4 class="fw-bold">Sibugay Technical Institute, Inc.</h4>
                        <p class="fs-6">COLLEGE PLACEMENT SYSTEM</p>
                    </div>
                </a>
            </div>
            <div class="col-md-6 right-side">
                <div class="col-md-8 mx-auto">
                    <div class="d-flex align-items-center justify-content-center text-center text-white mb-4 fw-bold">
                        <img src="../assets/images/key.png" class="img-fluid" alt="">
                        <h1 class="ms-2 my-0">LOG IN</h1>
                    </div>
                    <p class="text-center mb-4 text-light">Please enter your email address and password</p>
                    <br>
                    <form method="post">
                        <div class="mb-3">
                            <input value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" type="email" class="input-control" name="email" required>
                            <?php if (isset($error['email'])) : ?>
                                <p class="text-sm text-bg-danger px-2"><?= $error['email'] ?></p>
                            <?php endif ?>
                        </div>
                        <div class="mb-4">
                            <input value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>" type="password" class="input-control" name="password" required>
                            <?php if (isset($error['password'])) : ?>
                                <p class="text-sm text-bg-danger px-2"><?= $error['password'] ?></p>
                            <?php endif ?>
                        </div>
                        <div class="d-grid">
                            <button name="login" type="submit" class="btn btn-primary py-2 fw-medium border rounded-0">LOG IN</button>
                        </div>
                    </form>
                    <br>
                    <div class="mt-4 text-center text-white">
                        <p>No account yet? <a href="signup.php" class="link-light">Register here!</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>