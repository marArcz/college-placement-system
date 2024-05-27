<?php include '../includes/auth.php' ?>
<?php
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'applications';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Applications</title>
    <?php include '../includes/header.php' ?>
</head>

<body>
    <?php include '../includes/navbar.php' ?>
    <div class="content-header">
        <div class="d-flex align-items-center gap-3 justify-content-center py-3 text-white">
            <i class="fi fi-sr-folder d-flex fs-3"></i>
            <span class="fs-5 fw-semibold">Job Applications and Interviews</span>
        </div>
    </div>

    <div class="container mt-3">
        <!-- content -->
        <div class="col-md-8 mx-auto">
            <ul class="nav nav-underline mt-5 nav-fill ">
                <li class="nav-item">
                    <a class="nav-link <?= $active_tab == 'applications' ? 'active' : '' ?>" aria-current="page" href="?tab=applications">Applications</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $active_tab == 'interviews' ? 'active' : '' ?>" href="?tab=interviews">Interviews</a>
                </li>
            </ul>

            <div class="mt-3">
                <!-- applications -->
                <div class="applications-tab <?= $active_tab == 'applications' ? '' : 'd-none' ?>">
                    <?php
                    $q = $pdo->prepare("SELECT jobs.*,job_applications.*,job_applications.id as application_id FROM job_applications INNER JOIN students ON job_applications.student_id = students.id INNER JOIN jobs ON job_applications.job_id = jobs.id WHERE job_applications.student_id = ?");
                    $q->execute([$user['id']]);
                    $applications = $q->fetchAll();
                    ?>

                    <?php if (!$applications) : ?>
                        <p class="mt-4 text-center">You have no applications yet.</p>
                    <?php endif ?>

                    <?php foreach ($applications as $application) : ?>
                        <?php
                        switch ($application['status']) {
                            case 'submitted':
                                $status_color = 'secondary';
                                $status_text = 'Submitted';
                                break;
                            case 'reviewed':
                                $status_color = 'blue';
                                $status_text = 'Application reviewed';
                                break;
                            case 'interview_scheduled':
                                $status_color = 'success';
                                $status_text = 'Scheduled an interview';
                                break;
                            case 'rejected':
                                $status_color = 'danger';
                                $status_text = 'Rejected';
                                break;
                            case 'accepted':
                                $status_color = 'success';
                                $status_text = 'Accepted';
                                break;
                        }
                        ?>
                        <div class="card mb-3">
                            <div class="card-body p-lg-4">
                                <div class="d-flex">
                                    <div>
                                        <p class="fw-semibold mb-2 badge bg-light-<?= $status_color ?>"><?= $status_text ?></p>
                                        <p class="mb-1 fs-5 fw-semibold"><?= $application['title'] ?></p>
                                        <p class="mb-1 fw-medium"><?= $application['company'] ?></p>
                                        <p class="mb-1"><?= $application['location'] ?></p>
                                        <p class="mb-1 text-secondary fw-medium form-text">
                                            <?php $application_date = date('M d, Y', strtotime($application['application_date'])) ?>
                                            Applied <?= $application_date == date('M d, Y') ? 'today' : 'on ' . $application_date ?>
                                        </p>
                                    </div>
                                    <div class="ms-auto">
                                        <div class="dropdown">
                                            <a class="link-dark text-decoration-none" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fi fi-bs-menu-dots fs-4"></i>
                                            </a>

                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item py-2" href="view-application.php?id=<?= $application['id'] ?>">View details</a></li>
                                                <?php if ($application['status'] != 'accepted') : ?>
                                                    <li><a class="dropdown-item py-2" href="withdraw-application.php?id=<?= $application['id'] ?>">Withdraw application</a></li>
                                                <?php endif ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>

                <!-- interviews -->
                <div class="interviews-tab <?= $active_tab == 'interviews' ? '' : 'd-none' ?>">
                    <?php
                    $query = $pdo->prepare("SELECT jobs.title,jobs.company,job_applications.job_id, interviews.* FROM interviews INNER JOIN job_applications ON interviews.application_id = job_applications.id INNER JOIN jobs ON job_applications.job_id = jobs.id WHERE job_applications.student_id = ?");;
                    $query->execute([$user['id']]);
                    $interviews = $query->fetchAll();
                    ?>
                    <?php if (!$interviews) : ?>
                        <p class="mt-4 text-center">You have no scheduled interviews.</p>
                    <?php endif ?>

                    <?php foreach ($interviews as $interview) : ?>
                        <?php
                        switch ($interview['status']) {
                            case 'completed':
                                $status_color = 'success';
                                break;
                            case 'cancelled':
                                $status_color = 'danger';
                                break;
                            default:
                                $status_color = 'secondary';
                                break;
                        }
                        ?>
                        <div class="card shadow-sm mb-3">
                            <div class="card-body p-lg-4">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="fw-medium mb-3 text-capitalize badge bg-light-<?= $status_color ?>"><?= $interview['status'] ?></p>
                                        <p class="fw-semibold mb-1">For <?= $interview['title'] ?></p>
                                        <p class=" mb-1"><?= $interview['company'] ?></p>
                                        <p class=" mb-1 text-blue">Scheduled on - <?= date('M d, Y', strtotime($interview['date'])) ?></p>
                                        <p class="fw-semibold mb-0 text-capitalize badge bg-light-blue"><?= $interview['type'] ?></p>
                                    </div>
                                    <!-- <div class="ms-auto text-end">
                                        <p class="my-0 fs-6 text-capitalize fw-semibold text-blue"><?= $interview['type'] ?></p>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <?php include '../includes/scripts.php' ?>
</body>

</html>