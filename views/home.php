<?php include '../includes/auth.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <?php include '../includes/header.php' ?>
</head>

<body class="home">
    <?php include '../includes/navbar.php' ?>
    <section class="hero-dashboard d-flex justify-content-center align-items-center px-3">
        <div class="w-100">
            <div class="text-white text-center">
                <h1 class="fw-bold mb-5">How can we help you?</h1>
            </div>
        </div>
    </section>
    <sections class="cards">
        <div class="container-fluid">
            <div class="cards-wrapper">
                <div class="row justify-content-center w-100 gy-3 gx-3">
                    <div class="col-lg-3 col-md">
                        <div class="card hero-card shadow border-0">
                            <div class="card-body text-center p-lg-4">
                                <i class="fi fi-rr-briefcase fs-2 w-auto mx-auto"></i>
                                <p class="fw-bold fs-5">Job Search</p>
                                <p class="text-secondary">Check out our job posts.</p>
                                <a href="jobs.php" class="mt-2">Here</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md">
                        <div class="card hero-card shadow border-0">
                            <div class="card-body text-center p-lg-4">
                                <i class="fi fi-rs-user-gear fs-2 w-auto mx-auto"></i>
                                <p class="fw-bold fs-5">Manage Profile</p>
                                <p class="text-secondary">Build your profile for job applications.</p>
                                <a href="manage-profile.php" class="mt-2">Here</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md">
                        <div class="card hero-card shadow border-0">
                            <div class="card-body text-center p-lg-4">
                                <i class="fi fi-rr-calendar-clock fs-2 w-auto mx-auto"></i>

                                <p class="fw-bold fs-5">Applications & Interviews</p>
                                <p class="text-secondary">Track job applications and interview schedules.</p>
                                <a href="applications.php" class="mt-2">Here</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </sections>
    <br><br>
    <section class="mt-4">
        <div class="container py-3">
            <div class="text-center">
                <p class="fs-3">Streamline Your Path to Success with Our College Placement System</p>
                <div class="col-md-8 mx-auto">
                    <p>We are dedicated to connecting our talented students with top employers worldwide. Whether you are a student ready to embark on your professional journey or an employer looking for the best talent, our platform is designed to meet your needs. Start exploring opportunities and take the next step towards a successful future today.</p>
                </div>
                <br> <br>
                <div class=" mb-3">
                    <img src="../assets/images/about-img.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </section>
    <?php include '../includes/scripts.php' ?>
</body>

</html>