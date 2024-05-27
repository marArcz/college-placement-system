<nav class="navbar navbar-expand-lg bg-white border py-0">
    <div class="container my-0">
        <a class="navbar-brand" href="#">
            <div class="d-flex align-items-center">
                <img src="../../assets/images/navbar-logo.png" class="img-fluid" width="60" alt="">
                <p class="my-0 text-sm fw-medium d-none d-lg-block">
                    <small>Sibugay Technical Institute, Inc.</small>
                </p>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav ms-auto gap-4 align-items-center">

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
                                        <small>Admin</small>
                                    </p>
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end py-0">
                                <li class="border-bottom py-1">
                                    <a class="dropdown-item" href="profile.php">
                                        <i class="bi bi-person-fill me-2"></i>
                                        <small>Profile</small>
                                    </a>
                                </li>
                                <li class="border-bottom py-2">
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
<div class="secondary-nav bg-blue">
    <div class="container">
        <ul class="nav align-items-center">
            <li class="nav-item <?= $current_page == 'dashboard' ? 'active' : '' ?>">
                <a href="dashboard.php" class="nav-link link-light text-decoration-none">
                    <img src="../../assets/images/admin-dashboard.png" alt="" class="img-fluid">
                    <span class="d-none d-lg-block">Dashboard</span>
                </a>
            </li>
            <li class="nav-item <?= $current_page == 'jobs' ? 'active' : '' ?>">
                <a href="jobs.php"  class="nav-link link-light text-decoration-none ">
                    <img src="../../assets/images/admin-briefcase.png" alt="" class="img-fluid">
                    <span class="d-none d-lg-block">Job Posting</span>
                </a>
            </li>
            <li class="nav-item <?= $current_page == 'interviews' ? 'active' : '' ?> align-self-end">
                <a href="interviews.php" class="nav-link link-light text-decoration-none">
                    <i class="fi fi-sr-calendar-clock fs-4"></i>
                    <span class="d-none d-lg-block">Interviews</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="small-nav bg-white border">
    <div class="container">
        <div class="d-flex w-100 align-items-center px-4">
            <p class="text-primary text-decoration-none my-0">
                <i class=" m-0 fi fi-ss-dashboard d-flex fs-4"></i>
                <!-- <i class="fi fi-ss-dashboard"></i> -->
            </p>
            <div>
                <img src="../../assets/images/Line-separator.svg" class="ms-3" height="40" width="40" alt="">
            </div>
            <div>
                <p class="my-0 text-sm">
                    <small><?= isset($header)?$header:'' ?></small>
                </p>
            </div>
        </div>
    </div>
</div>