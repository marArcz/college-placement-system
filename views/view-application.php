<?php include '../includes/auth.php' ?>
<?php
if (!isset($_GET['id'])) {
    Session::redirectTo('applications.php');
    exit;
}

$query = $pdo->prepare("SELECT jobs.title,jobs.company, jobs.location,job_applications.* FROM job_applications INNER JOIN jobs ON job_applications.job_id = jobs.id WHERE job_applications.id = ?");
$query->execute([$_GET['id']]);

$application = $query->fetch();

$query = $pdo->prepare("SELECT * FROM resumes WHERE student_id=?");
$query->execute([$user['id']]);
$resume = $query->fetch();


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
        <div class="d-flex align-items-center justify-content-center py-3 text-white">
            <i class="fi fi-sr-folder fs-4 me-2 d-flex"></i>
            <span class="fs-5 fw-bold">Job Application</span>
        </div>
    </div>

    <div class="container mt-3">
        <!-- content -->
        <div class="col-md-9 mx-auto">
            <a href="applications.php" class=" text-decoration-none">
                <i class="fi fi-br-arrow-small-left fs-3"></i>
            </a>
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
            <div class="card rounded-3 shadow-sm">
                <div class="card-body p-lg-4">
                    <p class="fw-semibold mb-2 badge bg-light-<?= $status_color ?>"><?= $status_text ?></p>
                    <p class="fs-5 fw-bold mt-3 mb-1">
                        <?= $application['title'] ?>
                    </p>
                    <p class="mb-1 fs-6 fw-medium"><?= $application['company'] ?></p>
                    <p class="mb-1 fs-6 fw-medium"><?= $application['location'] ?></p>
                    <p class="mb-1 fs-6 text-secondary fw-medium">Applied on <?= date('M d, Y', strtotime($application['application_date'])) ?></p>
                </div>
            </div>
            <div class="card rounded-3 shadow-sm mt-3 mb-3">
                <div class="card-header bg-white">
                    <p class="fs-6 text-secondary my-2 fw-semibold">Application Details</p>
                </div>
                <div class="card-body p-lg-4">
                    <div class="application-details mt-3">
                        <div class="d-flex">
                            <div>
                                <p class="fw-bold fs-5 mb-1 "><?= $user['firstname'] ?> <?= $user['lastname'] ?></p>
                                <p class="mb-1 text-secondary"><?= $user['phone'] ?></p>
                                <p class="text-secondary mb-1"><?= $user['email'] ?></p>
                                <p class="text-secondary"><?= $user['address'] ?></p>
                            </div>
                        </div>
                        <br>
                        <div class="">
                            <div class="mb-3">
                                <?php
                                $query = $pdo->prepare("SELECT * FROM resume_summaries WHERE resume_id = ?");
                                $query->execute([$resume['id']]);
                                $summary = $query->fetch();
                                ?>

                                <div class="d-flex align-items-center mb-2">
                                    <div>
                                        <p for="" class="form-label fw-semibold fs-5">Summary</p>
                                    </div>
                                </div>

                                <?php if ($summary) : ?>
                                    <p class="d-none" id="summary-content"><?= $summary['summary'] ?></p>
                                    <div id="summary-quill" class="rounded-3 p-0 border-0 fs-6">
                                    </div>
                                <?php else : ?>
                                    <div class="card border">
                                        <div class="card-body p-lg-4">
                                            <p class="mb-0 text-secondary">No summary added yet.</p>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="mb-3 mt-4">
                            <!-- get personal info -->
                            <?php
                            $query = $pdo->prepare("SELECT * FROM personal_infos WHERE resume_id = ?");
                            $query->execute([$resume['id']]);
                            $personal_info = $query->fetch();
                            ?>
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="form-label fw-semibold mb-3 fs-5">Personal Information</p>
                                </div>
                            </div>
                            <div class="border card rounded-3">
                                <div class="card-body p-lg-4">
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
                                    <p class="form-label fw-semibold my-0 fs-5">Work experience</p>
                                </div>

                            </div>
                            <div class="mt-3">
                                <?php foreach ($experiences as $experience) : ?>
                                    <div class="card mb-2 border rounded-3">
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
                                    <p class="form-label fw-semibold my-0 fs-5">Education</p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <?php foreach ($educations as $education) : ?>
                                    <div class="card mb-2 border rounded-3">
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
                                    <p class="form-label fw-semibold my-0 fs-5">Skills</p>
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
        })
    </script>
</body>

</html>