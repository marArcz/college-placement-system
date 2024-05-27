<?php require '../includes/auth.php' ?>
<?php
if (!isset($_GET['id'])) {
    Session::redirectTo('jobs.php');
}

$query = $pdo->prepare("SELECT * FROM jobs WHERE id=?");
$query->execute([$_GET['id']]);

$job = $query->fetch();

$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'applicants';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $job['title'] ?> | Admin</title>
    <?php include '../includes/header.php' ?>
</head>

<body class="dashboard">
    <?php $current_page = 'jobs' ?>
    <?php $header = 'Jobs' ?>
    <?php include '../includes/navbar.php' ?>
    <main class="pt-4">
        <div class="container">
            <div class="d-flex">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="jobs.php">Postings</a></li>
                            <li class="breadcrumb-item active fw-semibold" aria-current="page"><?= $job['title'] ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="mt-2 mb-4">
                <div class="card rounded-3 border shadow-sm">
                    <div class="card-body p-lg-4">
                        <div class="row">
                            <div class="col-md-9">
                                <p class="mb-2 fs-4 fw-semibold"><?= $job['title'] ?></p>
                                <p class="mb-2 fw-medium"><?= $job['company'] ?></p>
                                <p class="fw-light text-capitalize mb-2"><?= $job['job_type'] ?></p>
                                <?php if ($job['deadline'] && $job['status'] == 'open') : ?>
                                    <p class="mb-0 form-text">Application deadline - <?= date('M d, Y', strtotime($job['deadline'])) ?></p>
                                <?php endif ?>
                                <p class="mb-1 badge bg-light-blue fw-semibold text-capitalize mt-2"><?= $job['status'] ?></p>

                                <?php if ($job['status'] == 'open') : ?>
                                    <div class="mt-4">
                                        <div class="d-flex gap-2">
                                            <a href="edit-job.php?id=<?= $_GET['id'] ?>" class="btn btn-blue">Edit Posting</a>
                                            <button class="btn btn-outline-blue">Delete Posting</button>
                                            <a href="update-job-status.php?id=<?= $_GET['id'] ?>&status=closed" class="btn btn-outline-blue">Close Application</a>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </div>
                            <div class="col-md">
                                <!-- get job applicants and views -->
                                <?php
                                //applicants
                                $q = $pdo->prepare('SELECT COUNT(id) FROM job_applications WHERE job_id = ?');
                                $q->execute([$job['id']]);
                                $applicants = $q->fetch()[0];
                                // views
                                $q = $pdo->prepare('SELECT COUNT(id) FROM job_views WHERE job_id = ?');
                                $q->execute([$job['id']]);
                                $views = $q->fetch()[0];
                                ?>
                                <div class="d-flex gap-3">
                                    <div class="text-end">
                                        <p class="mb-1 fw-semibold fs-5"><?= $views ?></p>
                                        <p class="my-0 fw-medium text-secondary">Views</p>
                                    </div>
                                    <div class="text-end">
                                        <p class="mb-1 fw-semibold fs-5"><?= $applicants ?></p>
                                        <p class="my-0 fw-medium text-secondary">Applicants</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md text-end">
                                <?php if ($job['status'] == 'open') : ?>
                                    <button class="btn btn-light-blue fw-bold" type="submit">
                                        Active
                                    </button>
                                <?php endif ?>
                            </div>
                        </div>

                        <ul class="nav nav-underline mt-5 nav-fill">
                            <li class="nav-item">
                                <a class="nav-link <?= $active_tab == 'applicants' ? 'active' : '' ?>" aria-current="page" href="?id=<?= $_GET['id'] ?>&tab=applicants">Applicants</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $active_tab == 'job' ? 'active' : '' ?>" href="?id=<?= $_GET['id'] ?>&tab=job">View Job</a>
                            </li>
                        </ul>

                        <!-- applicants tab -->
                        <div class="applicants-tab <?= $active_tab == 'applicants' ? '' : 'd-none' ?>">
                            <?php
                            $query = $pdo->prepare("SELECT job_applications.*,students.firstname,students.lastname FROM job_applications INNER JOIN students ON job_applications.student_id = students.id WHERE job_applications.job_id = ?");
                            $query->execute([$job['id']]);
                            $applications = $query->fetchAll();
                            ?>
                            <div class="mt-4">
                                <?php foreach ($applications as $application) : ?>
                                    <div class="mb-3">
                                        <div class="row align-items-center gy-3">
                                            <div class="col-md-8">
                                                <div class="d-flex flex-wrap align-items-center gap-3">
                                                    <div>
                                                        <?php
                                                        if (!empty($application['photo'])) {
                                                        ?>
                                                            <div id="profile-pic-div" class="image-div <?= $profile_pic_size ?? 'lg' ?>" data-image="../assets/images/<?= $user['photo'] ?>"></div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="text-profile-pic photo <?= $profile_pic_size ?? 'lg' ?> shadow-sm bg-secondary border-light border-2 border text-light ">
                                                                <div class="text fw-normal">
                                                                    <?= $application['firstname'][0] .  $application['lastname'][0] ?>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div>
                                                        <p class="mb-1 fw-semibold"><?= $application['firstname'] . ' ' . $application['lastname'] ?></p>
                                                        <p class="mb-0 text-secondary">
                                                            Application date - <?= date('M d, Y', strtotime($application['application_date'])) ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-auto ms-auto">
                                                <?php
                                                if ($application['status'] == 'accepted' || $application['status'] == 'rejected') {
                                                ?>
                                                    <p class="my-0 fw-semibold text-capitalize badge bg-light-blue"><?= $application['status'] ?></p>
                                                <?php
                                                } else {
                                                ?>
                                                    <a class="btn btn-blue" href="view-application.php?id=<?= $application['id'] ?>">View Application</a>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                            <?php if (!$applicants) : ?>
                                <p class="mt-3 fw-medium fs-5 text-secondary text-center">You don't have any applicants yet.</p>
                            <?php endif ?>
                        </div>
                        <!-- job info tab -->
                        <div class="job-tab <?= $active_tab == 'job' ? '' : 'd-none' ?>">
                            <h4 class="mt-3 text-blue">Job Details</h4>
                            <p class="mt-3 d-flex align-items-center fw-semibold text-secondary mb-1">
                                <i class="fi fi-sr-briefcase me-2"></i>
                                <span>Job Type</span>
                            </p>
                            <p class="mb-1 text-capitalize ms-4 fw-medium"><?= $job['job_type'] ?></p>
                            <hr>
                            <h4 class="text-blue mb-3">Location</h4>
                            <p>
                                <i class="fi fi-sr-map-pin me-2"></i>
                                <span><?= $job['location'] ?></span>
                            </p>
                            <hr>
                            <h4 class="text-blue mb-1">Full Job Description</h4>
                            <p id="description-content" class="d-none"><?= $job['description'] ?></p>
                            <div id="quill-display" class="border-0 fs-6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include '../includes/scripts.php' ?>
    <script>
        $(function() {
            const quill = new Quill("#quill-display", {
                theme: 'snow',
                readOnly: true,
                modules: {
                    toolbar: false,
                },
            })
            quill.setContents(JSON.parse($("#description-content").html()))
        })
    </script>
</body>

</html>