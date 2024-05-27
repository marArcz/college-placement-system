<nav class="navbar navbar-expand-lg bg-white border py-0">
    <div class="container my-0">
        <a class="navbar-brand" href="#">
            <div class="d-flex align-items-center">
                <img src="../assets/images/navbar-logo.png" class="img-fluid" alt="">
                <p class="my-0 fs-6 fw-medium d-none d-lg-block">
                    Sibugay Technical Institute, Inc.
                </p>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav ms-auto gap-4 align-items-center">
                <!-- <li class="nav-item">
                    <a class="nav-link active fs-6 fw-bold" aria-current="page" href="#">
                        <i class="fi fi-rr-bell fs-4 d-flex text-secondary"></i>
                    </a>
                </li> -->
            
                <?php if ($user) : ?>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn btn-sm d-flex align-items-center gap-2 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php
                                $profile_pic_size = 'sm';
                                require_once '../includes/user-profile-pic.php'
                                ?>
                                <div class="text-start text-dark d-none d-md-block">
                                    <p class="my-0 fw-semibold"><?= $user['firstname'] . ' ' .  $user['lastname'] ?></p>
                                    <p class="my-0">
                                        <small>Student</small>
                                    </p>
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end py-0">
                                <li class="border-bottom py-2">
                                    <a class="dropdown-item" href="applications.php">
                                        <i class="bi bi-person-fill me-2"></i>
                                        <small>Job applications</small>
                                    </a>
                                </li>
                                <li class=" py-2">
                                    <a class="dropdown-item delete" href="logout.php">
                                        <i class="bx bx-log-out me-2"></i>
                                        <small>Log out</small>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>
<div class="secondary-nav bg-white border">
    <div class="container">
        <div class="d-flex w-100 align-items-center px-4">
            <a href="home.php" class="link-primary text-decoration-none">
                <i class=" m-0 fi fi-sr-house-chimney d-flex fs-3"></i>
            </a>
            <div>
                <img src="../assets/images/Line-separator.svg" class="ms-3" height="60" width="60" alt="">
            </div>
            <div>
                <p class="my-0">Welcome, <?= $user['firstname'] ?> <?= $user['lastname'] ?></p>
            </div>
        </div>
    </div>
</div>