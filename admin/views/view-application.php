<?php require '../includes/auth.php' ?>
<?php

if (!isset($_GET['id'])) {
    Session::redirectTo("jobs.php");
}

$query = $pdo->prepare("SELECT * FROM job_applications WHERE id = ?");
$query->execute([$_GET['id']]);
$application = $query->fetch();

// update application status to reviewed 
if ($application['status'] == 'submitted') {
    $query = $pdo->prepare("UPDATE job_applications SET status = 'reviewed' WHERE id = ?");
    $query->execute([$application['id']]);
}


$query = $pdo->prepare("SELECT * FROM jobs WHERE id = ?");
$query->execute([$application['job_id']]);
$job = $query->fetch();

$query = $pdo->prepare("SELECT students.*,users.email FROM students INNER JOIN users WHERE students.id = ?");
$query->execute([$application['student_id']]);
$student = $query->fetch();

$query = $pdo->prepare("SELECT * FROM resumes WHERE student_id = ?");
$query->execute([$student['id']]);
$resume = $query->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application | Admin</title>
    <?php include '../includes/header.php' ?>
</head>

<body class="bg-white">
    <?php $current_page = 'jobs' ?>
    <?php $header = $job['title'] ?>
    <?php include '../includes/navbar.php' ?>
    <div>
        <div class="container">
            <div class="mt-3">
                <div class="d-flex align-items-center">
                    <div>
                        <a href="manage-job.php?id=<?= $job['id'] ?>" class=" text-decoration-none">
                            <i class="fi fi-br-arrow-small-left fs-3"></i>
                        </a>
                    </div>
                    <div class="ms-auto">
                        <div class="d-flex gap-2 flex-wrap">
                            <!-- <a href="schedule-interview.php?id=<?= $application['id'] ?>" class="btn btn-blue">
                                <span>Schedule an interview</span>
                            </a>
                            <a href="" class="btn btn-outline-danger fw-medium">Reject</a> -->
                            <?php if ($job['status'] == 'open') : ?>
                                <div class="dropdown">
                                    <a class="btn btn-blue text-decoration-none dropdown-toggle text-capitalize" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="schedule-interview.php?id=<?= $application['id'] ?>">Schedule an interview</a></li>
                                        <li><a class="dropdown-item" href="update-application.php?id=<?= $application['id'] ?>&status=accepted">Accept</a></li>
                                        <li><a class="dropdown-item" href="update-application.php?id=<?= $application['id'] ?>&status=rejected">Reject</a></li>
                                    </ul>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="fs-5 fw-semibold my-0">Student Profile</p>
                            </div>

                        </div>
                        <hr>
                        <div class="card rounded-3 border-0">
                            <div class="card-body p-lg-4">
                                <div class="d-flex">
                                    <div>
                                        <p class="fw-bold fs-4 mb-1 "><?= $student['firstname'] ?> <?= $student['lastname'] ?></p>
                                        <p class="text-secondary mb-1"><?= $student['address'] ?></p>
                                        <p class="text-secondary mb-1">
                                            <a href="mailto:<?= $student['email'] ?>" class=""><?= $student['email'] ?></a>
                                        </p>
                                        <p class="mb-1 text-secondary"><?= $student['phone'] ?></p>
                                    </div>
                                </div>
                                <br>
                                <p class="fs-5 text-blue fw-semibold">Summary</p>
                                <?php
                                $query = $pdo->prepare("SELECT * FROM resume_summaries WHERE resume_id = ?");
                                $query->execute([$resume['id']]);
                                $summary = $query->fetch();
                                ?>
                                <div class="">
                                    <?php if ($summary) : ?>
                                        <p class="d-none" id="summary-content"><?= $summary['summary'] ?></p>
                                        <div id="summary-quill" class=" p-0 border-0 fs-6">
                                        </div>
                                    <?php else : ?>
                                        <div class="card border">
                                            <div class="card-body p-lg-4">
                                                <p class="mb-0 text-secondary">No summary added.</p>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                </div>
                                <p class="fs-5 fw-semibold text-blue mt-4 mb-1">Personal Information</p>
                                <?php
                                $query = $pdo->prepare("SELECT * FROM personal_infos WHERE resume_id = ?");
                                $query->execute([$resume['id']]);
                                $personal_info = $query->fetch();
                                ?>
                                <div class="border-0 card rounded-3">
                                    <div class="card-body">
                                        <?php if ($personal_info) : ?>
                                            <div class="mb-0">
                                                <p><span class="fw-semibold">Civil Status:</span> <?= $personal_info['civil_status'] ?></p>
                                                <p class="mb-0 mt-2"><span class="fw-semibold">Citizenship:</span> <?= $personal_info['citizenship'] ?></p>
                                            </div>
                                        <?php else : ?>
                                            <div>
                                                <p class=" d-flex align-items-center"><strong>Civil Status:</strong> <span>None</span></p>
                                                <p class="mb-0 d-flex align-items-center"><strong>Citizenship:</strong> <span>None</span></p>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <!-- work experiences -->
                                <?php
                                // get work experiences
                                $query = $pdo->prepare("SELECT * FROM experiences WHERE resume_id = ?");
                                $query->execute([$resume['id']]);
                                $experiences = $query->fetchAll();
                                ?>
                                <div class="d-flex mt-4">
                                    <div>
                                        <p class="form-label text-blue fw-semibold my-0 fs-5">Work experience</p>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <?php foreach ($experiences as $experience) : ?>
                                        <div class="card mb-2 border-0 rounded-3">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div>
                                                        <p class="fs-6 fw-semibold mb-1"><?= $experience['job_title'] ?></p>
                                                        <p class="fw-light mb-1"><?= $experience['company'] ?></p>
                                                        <p class="fw-light mb-0">
                                                            <span><?= $experience['month_from'] . ' ' . $experience['year_from'] ?> to <?= $experience['is_current_job'] ? 'Present' : $experience['month_to'] . ' ' . $experience['year_to'] ?></span>
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <!-- education -->
                                <?php
                                // get education
                                $query = $pdo->prepare("SELECT * FROM educations WHERE resume_id = ?");
                                $query->execute([$resume['id']]);
                                $educations = $query->fetchAll();
                                ?>
                                <div class="d-flex mt-4">
                                    <div>
                                        <p class="form-label text-blue fw-semibold my-0 fs-5">Education</p>
                                    </div>

                                </div>
                                <div class="mt-3">
                                    <?php foreach ($educations as $education) : ?>
                                        <div class="card mb-2 border-0 rounded-3">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div>
                                                        <p class="fs-6 fw-semibold mb-1"><?= $education['level'] ?></p>
                                                        <p class="fw-light mb-1"><?= $education['school'] ?></p>
                                                        <p class="fw-light mb-0">
                                                            <span><?= $education['year_from'] ?> to <?= $education['currently_enrolled'] ? 'Present' :  $education['year_to'] ?></span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <!-- skills -->
                                <?php
                                // get skills
                                $query = $pdo->prepare("SELECT * FROM skills WHERE resume_id = ?");
                                $query->execute([$resume['id']]);
                                $skills = $query->fetchAll();
                                ?>
                                <div class="d-flex mt-4">
                                    <div>
                                        <p class="form-label text-blue fw-semibold my-0 fs-5">Skills</p>
                                    </div>

                                </div>
                                <div class="mt-3">
                                    <?php foreach ($skills as $skill) : ?>
                                        <div class="card mb-2 border rounded-3">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div>
                                                        <p class="fs-6 d-flex align-items-center gap-2 mb-0 fw-semibold">
                                                            <span><?= $skill['name'] ?></span>
                                                            <span class="text-secondary">
                                                                <?= $skill['years_exp'] ? '-' : '' ?>
                                                            </span>
                                                            <span class="text-secondary"><?= $skill['years_exp'] ?></span>
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md">
                        <div class="job-tab">
                            <p class="fs-5 fw-semibold">Job Information</p>
                            <div class="card">
                                <div class="card-body p-lg-4">
                                    <h4 class=" text-blue">Job Details</h4>
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
                    </div> -->
                </div>
            </div>
        </div>

    </div>
    <?php include '../includes/scripts.php' ?>
    <script>
        $(function() {
            const quill = new Quill("#summary-quill", {
                theme: 'snow',
                readOnly: true,
                modules: {
                    toolbar: false,
                },
            })
            quill.setContents(JSON.parse($("#summary-content").html()))

            const descriptionQuill = new Quill("#quill-display", {
                theme: 'snow',
                readOnly: true,
                modules: {
                    toolbar: false,
                },
            })
            descriptionQuill.setContents(JSON.parse($("#description-content").html()))
        })
    </script>
</body>

</html>