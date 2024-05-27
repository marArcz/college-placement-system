<?php include '../includes/auth.php' ?>
<?php include '../includes/job_views.php' ?>
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
    <title>Home</title>
    <?php include '../includes/header.php' ?>
</head>

<body>
    <?php include '../includes/navbar.php' ?>
    <div class="content-header">
        <div class="d-flex align-items-center gap-3 justify-content-center py-3 text-white">
            <i class="fi fi-sr-briefcase d-flex fs-5 "></i>
            <span class="fs-5 fw-bold">Jobs</span>
        </div>
    </div>

    <div class="container mt-4">
        <a href="jobs.php" class=" text-decoration-none">
            <i class="fi fi-br-arrow-small-left fs-3"></i>
        </a>
        <!-- content -->
        <p class="mb-2 fs-4 fw-semibold"><?= $job['title'] ?></p>
        <p class="mb-2 fw-medium"><?= $job['company'] ?></p>
        <p class="fw-light text-capitalize mb-2"><?= $job['job_type'] ?></p>
        <?php if ($job['deadline']) : ?>
            <p class="mb-0 form-text">Application deadline - <?= date('M d, Y', strtotime($job['deadline'])) ?></p>
        <?php endif ?>

        <div class="mt-4">
            <div class="d-flex gap-2">
                <a href="apply-job.php?id=<?= $_GET['id'] ?>#profile" class="btn btn-blue">Apply Now</a>
            </div>
        </div>
        <div class="mt-5">
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