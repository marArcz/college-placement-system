<?php include '../app/signup.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Placement System | Signup</title>
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
                <div class="col-md-10 mx-auto">
                    <div class="d-flex mt-3 align-items-center justify-content-center text-center text-white mb-4 fw-bold">
                        <!-- <img src="../assets/images/key.png" class="img-fluid" alt=""> -->
                        <h2 class="my-0">CREATE YOUR ACCOUNT</h2>
                    </div>
                    <br>
                    <form method="POST">
                        <div class="mb-3">
                            <div class="row gy-3">
                                <div class="col-md">
                                    <input type="text" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>" class="input-control" placeholder="Firstname" name="firstname" required>

                                </div>
                                <div class="col-md">
                                    <input type="text" value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>" class="input-control" placeholder="Lastname" name="lastname" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row gy-3">
                                <div class="col-md">
                                    <input type="text" value="<?= isset($_POST['course']) ? $_POST['course'] : '' ?>" class="input-control" placeholder="Course" name="course" required>
                                </div>
                                <div class="col-md">
                                    <input type="number" value="<?= isset($_POST['graduation_year']) ? $_POST['graduation_year'] : '' ?>" class="input-control" placeholder="Graduation Year" name="graduation_year" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="number" value="<?= isset($_POST['phone']) ? $_POST['phone'] : '' ?>" class="input-control" name="phone" placeholder="Phone" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" class="input-control" placeholder="Email" name="email" required>
                            <?php if (isset($error['email'])) : ?>
                                <p class="text-sm text-bg-danger px-2"><?= $error['email'] ?></p>
                            <?php endif ?>
                        </div>
                        <div class="mb-3">
                            <input type="text" value="<?= isset($_POST['address']) ? $_POST['address'] : '' ?>" class="input-control" placeholder="Address" name="address" required>
                            <?php if (isset($error['address'])) : ?>
                                <p class="text-sm text-bg-danger px-2"><?= $error['address'] ?></p>
                            <?php endif ?>
                        </div>
                        <div class="mb-3">
                            <div class="row gy-3">
                                <div class="col-md">
                                    <input type="password" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>" class="input-control" placeholder="Password" name="password" required>
                                    <?php if (isset($error['password'])) : ?>
                                        <p class="text-sm text-bg-danger px-2"><?= $error['password'] ?></p>
                                    <?php endif ?>
                                </div>
                                <div class="col-md">
                                    <?php if (isset($error['password'])) : ?>
                                        <p class="text-sm text-bg-danger px-2"><?= $error['password'] ?></p>
                                    <?php endif ?>
                                    <input type="password" value="<?= isset($_POST['confirm_pass']) ? $_POST['confirm_pass'] : '' ?>" class="input-control" placeholder="Confirm Password" name="confirm_pass" required>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button name="signup" type="submit" class="btn btn-primary py-2 fw-medium border rounded-0">REGISTER</button>
                        </div>
                    </form>
                    <br>
                    <div class="mt-4 text-center text-white">
                        <p>Already have an account? <a href="login.php" class="link-light">Log in here!</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>