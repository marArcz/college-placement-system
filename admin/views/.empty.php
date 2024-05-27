<?php require '../includes/auth.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Admin</title>
    <?php include '../includes/header.php' ?>
</head>

<body class="dashboard">
    <?php $current_page = 'dashboard' ?>
    <?php $header = 'Dashboard' ?>
    <?php include '../includes/navbar.php' ?>
    <section class="hero">
        <div class="w-100">
            <div class="text-white text-center">
                <h2 class="fw-semibold">Welcome, <?= $user['firstname'] . ' ' . $user['lastname'] ?>!</h2>
            </div>
        </div>
        <div class="cards-wrapper">
            <div class="container">
                <div class="row justify-content-center w-100 gy-3">
                    <div class="col-md-4">
                        <div class="card hero-card shadow border-0 h-100">
                            <div class="card-body p-lg-4">
                                <?php
                                // get number of page visits
                                $query = $pdo->query("SELECT COUNT(id) FROM page_visits");
                                $page_visits = $query->fetch()[0];
                                ?>
                                <div class="d-flex align-items-center flex-wrap">
                                    <div class="">
                                        <div class="">
                                            <img src="../../assets/images/page-visits.png" class="img-fluid mb-3" alt="">
                                            <p class="my-0 text-blue fw-semibold fs-5">Page Visits</p>
                                        </div>
                                    </div>
                                    <div class="ms-auto ">
                                        <div class="card-value">
                                            <p class="my-0 fw-semibold fs-4"><?= $page_visits ?></p>
                                        </div>
                                    </div>
                                </div>
                                <p class=" mt-3">Number of people that visited and interacted with the website.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card hero-card shadow border-0 h-100">
                            <div class="card-body p-lg-4">
                                <?php
                                // get number of page visits
                                $query = $pdo->query("SELECT COUNT(id) FROM jobs");
                                $count = $query->fetch()[0];
                                ?>
                                <div class="d-flex align-items-center flex-wrap">
                                    <div class="">
                                        <div class="">
                                            <img src="../../assets/images/jobs-posted.png" class="img-fluid mb-3" alt="">
                                            <p class="my-0 text-blue fw-semibold fs-5">Jobs Posted</p>
                                        </div>
                                    </div>
                                    <div class="ms-auto ">
                                        <div class="card-value">
                                            <p class="my-0 fw-semibold fs-4"><?= $count ?></p>
                                        </div>
                                    </div>
                                </div>
                                <p class=" mt-3">Number of jobs posted.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card hero-card shadow border-0 h-100">
                            <div class="card-body p-lg-4">
                                <?php
                                // get number of page visits
                                $query = $pdo->query("SELECT COUNT(id) FROM job_applications");
                                $count = $query->fetch()[0];
                                ?>
                                <div class="d-flex align-items-center flex-wrap">
                                    <div class="">
                                        <div class="">
                                            <!-- <img src="../../assets/images/jobs-posted.png" class="img-fluid mb-3" alt=""> -->
                                            <i class="fi fi-rr-folder fs-2"></i>
                                            <p class="my-0 text-blue fw-semibold fs-5">Job Applications</p>
                                        </div>
                                    </div>
                                    <div class="ms-auto ">
                                        <div class="card-value">
                                            <p class="my-0 fw-semibold fs-4"><?= $count ?></p>
                                        </div>
                                    </div>
                                </div>
                                <p class=" mt-3">Number of jobs posted.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <?php include '../includes/scripts.php' ?>
</body>

</html>