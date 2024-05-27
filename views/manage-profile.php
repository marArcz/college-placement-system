<?php include '../includes/auth.php' ?>
<?php
$active_section_key = isset($_GET['section']) ? $_GET['section'] : 'personal';

// check if user have no resume yet
$query = $pdo->prepare("SELECT * FROM resumes WHERE student_id = ?");
$query->execute([$user['id']]);

if ($query->rowCount() == 0) {
    $query = $pdo->prepare("INSERT INTO resumes(student_id,last_section) VALUES(?,?)");
    $query->execute([$user['id'], 'personal']);
    $id = $pdo->lastInsertId();
    $query = $pdo->prepare("SELECT * FROM resumes WHERE id = ?");
    $query->execute([$id]);
    $resume = $query->fetch();
} else {
    $resume = $query->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <?php include '../includes/header.php' ?>
</head>

<body class="manage-profile <?= Session::hasSession('job_id') ? 'applying' : '' ?>">
    <?php include '../includes/navbar.php' ?>
    <div class="content-header">
        <div class="d-flex align-items-center justify-content-center py-3 text-white">
            <i class="fi fi-sr-user-skill-gear fs-3"></i>
            <span class="fs-5 fw-bold">Manage Profile</span>
        </div>
    </div>

    <div class="container mt-3 ">
        <div class="col-md-8 mx-auto mt-4">
            <div class="d-flex">
                <div>
                    <p class="fw-bold fs-4 mb-1 "><?= $user['firstname'] ?> <?= $user['lastname'] ?></p>
                    <p class="mb-1 text-secondary"><?= $user['phone'] ?></p>
                    <p class="text-secondary mb-1"><?= $user['email'] ?></p>
                    <p class="text-secondary"><?= $user['address'] ?></p>
                </div>
                <div class="ms-auto">
                    <a href="edit-profile.php" class="link link-dark text-decoration-none fs-5 ">
                        <i class="fi fi-sr-pencil d-flex align-items-center"></i>
                    </a>
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
                        <div class="ms-auto">
                            <?php if ($summary) : ?>
                                <a href="edit-summary.php?s=<?= $summary['id'] ?>" class="link link-dark text-decoration-none fs-5 ">
                                    <i class="fi fi-sr-pencil d-flex align-items-center"></i>
                                </a>
                            <?php else : ?>
                                <a href="add-summary.php?r=<?= $resume['id'] ?>" class="link link-dark text-decoration-none fs-2 ">
                                    <i class="fi fi-sr-plus-small d-flex align-items-center"></i>
                                </a>
                            <?php endif ?>
                        </div>
                    </div>

                    <?php if ($summary) : ?>
                        <p class="d-none" id="summary-content"><?= $summary['summary'] ?></p>
                        <div id="summary-quill" class="rounded-3 p-2 fs-6">
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
                    <div class="ms-auto">
                        <?php if ($personal_info) : ?>
                            <a href="edit-summary.php?id=<?= $summary['id'] ?>" class="link-dark fs-5 text-decoration-none">
                                <i class="fi fi-sr-pencil d-flex align-items-center"></i>
                            </a>
                        <?php else : ?>
                            <a href="add-personal-info.php?id=<?= $resume['id'] ?>" class="link-dark fs-2 text-decoration-none">
                                <i class="fi fi-sr-plus-small d-flex align-items-center"></i>
                            </a>
                        <?php endif ?>
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
                    <div class="ms-auto">
                        <a href="add-work-experience.php?id=<?= $resume['id'] ?>" class="link-dark fs-2 text-decoration-none">
                            <i class="fi fi-sr-plus-small d-flex align-items-center"></i>
                        </a>
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
                                    <div class="ms-auto">
                                        <div class="d-flex gap-3">
                                            <a href="edit-work-experience.php?id=<?= $experience['id'] ?>" class="link-dark fs-6 text-decoration-none">
                                                <i class="fi fi-sr-pencil d-flex align-items-center"></i>
                                            </a>
                                            <a href="delete-work-experience.php?id=<?= $experience['id'] ?>" class="link-dark fs-6 text-decoration-none">
                                                <i class="fi fi-sr-trash d-flex align-items-center"></i>
                                            </a>
                                        </div>
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
                    <div class="ms-auto">
                        <a href="add-education.php?id=<?= $resume['id'] ?>" class="link-dark fs-2 text-decoration-none">
                            <i class="fi fi-sr-plus-small d-flex align-items-center"></i>
                        </a>
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
                                    <div class="ms-auto">
                                        <div class="d-flex gap-3">
                                            <a href="edit-education.php?id=<?= $education['id'] ?>" class="link-dark fs-6 text-decoration-none">
                                                <i class="fi fi-sr-pencil d-flex align-items-center"></i>
                                            </a>
                                            <a href="delete-education.php?id=<?= $education['id'] ?>" class="link-dark fs-6 text-decoration-none">
                                                <i class="fi fi-sr-trash d-flex align-items-center"></i>
                                            </a>
                                        </div>
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
                    <div class="ms-auto">
                        <a href="add-skill.php?id=<?= $resume['id'] ?>" class="link-dark fs-2 text-decoration-none">
                            <i class="fi fi-sr-plus-small d-flex align-items-center"></i>
                        </a>
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
                                    <div class="ms-auto">
                                        <div class="d-flex gap-3">
                                            <a href="edit-skill.php?id=<?= $skill['id'] ?>" class="link-dark fs-6 text-decoration-none">
                                                <i class="fi fi-sr-pencil d-flex align-items-center"></i>
                                            </a>
                                            <a href="delete-skill.php?id=<?= $skill['id'] ?>" class="link-dark fs-6 text-decoration-none">
                                                <i class="fi fi-sr-trash d-flex align-items-center"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>

                <!-- continue applying footer -->
                <div class="continue-applying">
                    <div class="inner">
                        <div class="col-md-6 mx-auto">
                            <div class="text-end">
                                <a href="continue-applying-job.php" class="btn btn-blue py-2 fs-6 fw-semibold">Continue applying</a>
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