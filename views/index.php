<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include '../includes/header.php' ?>
    <script src="https://cdn.lottielab.com/s/lottie-player@1.x/player-web.min.js"></script>
</head>

<body class="home">
    <nav class="navbar navbar-expand-lg bg-body-tertiary py-0">
        <div class="container my-0">
            <a class="navbar-brand" href="#">
                <div class="d-flex align-items-center">
                    <img src="../assets/images/navbar-logo.png" class="img-fluid" alt="">
                    <p class="my-0 fw-medium d-none d-lg-block">
                        Sibugay Technical Institute, Inc.
                    </p>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav ms-auto gap-4">
                    <li class="nav-item">
                        <a class="nav-link fs-6 fw-medium" href="login.php">LOG IN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero d-flex justify-content-center align-items-center px-3">
        <div class="text-white text-center">
            <h1 class="fw-bold">SIBUGAY TECHNICAL INSTITUTE INCORPORATED</h1>
            <p class="mt-3 fs-5 fw-medium">Connecting Students with Future Opportunities</p>
        </div>
    </section>
    <section class="about">
        <div class="container">
            <div class="hello-img-wrapper rounded-circle shadow">
                <!-- <img src="../assets/images/hi.png" class="img-fluid mx-auto text-center" alt=""> -->
                <lottie-player src="../assets/lottie/hi.json" autoplay loop>
                </lottie-player>
            </div>

            <div class="mt-1 text-center">
                <h4>Welcome to our College Placement System</h4>
                <div class="col-md-10 mt-4 mx-auto">
                    <p>We are dedicated to connecting our talented students with top employers worldwide. Whether you are a student ready to embark on your professional journey or an employer looking for the best talent, our platform is designed to meet your needs. Start exploring opportunities and take the next step towards a successful future today.</p>
                </div>
            </div>
            <br><br><br>
            <div class=" mb-4">
                <div class="text-center">
                    <h4 class="fw-bold">Key Features</h4>
                </div>
                <br><br>
                <div class="col-md-10 mx-auto">
                    <div class="row gy-3">
                        <div class="col-md">
                            <div class="card h-100 bg-blue">
                                <div class="card-body text-light p-lg-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <div>
                                            <img src="../assets/images/job-search.png" class="img-fluid" height="100px" width="100px" alt="">
                                        </div>
                                        <div>
                                            <p class="fw-bold fs-5">Jobs Search</p>
                                            <p class="mb-0">Let’s help you find a job that aligns with your skills and interest.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="card h-100 bg-blue">
                                <div class="card-body text-light p-lg-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <div>
                                            <img src="../assets/images/profile-management.png" class="img-fluid" height="100px" width="100px" alt="">
                                        </div>
                                        <div>
                                            <p class="fw-bold fs-5">Profile Management</p>
                                            <p class="mb-0">Empower student by allowing them to create a comprehensive resume</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="card h-100 bg-blue">
                                <div class="card-body text-light p-lg-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <div>
                                            <img src="../assets/images/scheduling.png" class="img-fluid" height="100px" width="100px" alt="">
                                        </div>
                                        <div>
                                            <p class="fw-bold fs-5">Interview Scheduling</p>
                                            <p class="mb-0">Easily track interview schedules for your job applications.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include '../includes/scripts.php' ?>
</body>

</html>