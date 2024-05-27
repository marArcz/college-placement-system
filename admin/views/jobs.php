<?php require '../includes/auth.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Posting | Admin</title>
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
                    <p class="fw-semibold fs-5 my-0">Manage Postings</p>
                </div>
                <div class="ms-auto">
                    <a href="add-job.php" class="btn btn-blue d-flex align-items-center ms-auto fw-semibold py-2">
                        <i class="fi fi-sr-plus fs-6 d-flex me-3"></i>
                        <span>Add</span>
                    </a>
                </div>
            </div>
            <div class="mt-2 mb-3">
                <div class="card rounded-3 border shadow-sm">
                    <div class="card-header bg-white">
                        <div class="d-flex align-items-center my-2 justify-content-between">
                            <div>
                                <p class="my-0 fw-bold text-dark">Jobs</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <?php
                            $query = $pdo->prepare("SELECT * FROM jobs ORDER BY id DESC");
                            $query->execute();
                            while ($row = $query->fetch()) {
                            ?>
                                <div class="list-group-item mb-2">
                                    <div class="row align-items-center gy-3">
                                        <div class="col-md-6">
                                            <p class="mb-1 fw-semibold"><?= $row['title'] ?></p>
                                            <p class="mb-1 fw-medium"><?= $row['company'] ?></p>
                                            <p class="fw-light text-capitalize mb-2"><?= $row['job_type'] ?> | <span class="text-success"><?= $row['salary_range'] ?></span></p>
                                            <?php if($row['deadline']): ?>
                                                <p class="mb-0 form-text">Application deadline - <?= date('M d, Y',strtotime($row['deadline'])) ?></p>
                                            <?php endif ?>
                                            <p class="form-text text-secondary">
                                                Date posted - <?= date('M d, Y',strtotime($row['posting_date'])) ?>
                                            </p>
                                        </div>
                                        <div class="col-md">
                                            <!-- get job applicants and views -->
                                            <?php
                                            //applicants
                                            $q = $pdo->prepare('SELECT COUNT(id) FROM job_applications WHERE job_id = ?');
                                            $q->execute([$row['id']]);
                                            $applicants = $q->fetch()[0];
                                            // views
                                            $q = $pdo->prepare('SELECT COUNT(id) FROM job_views WHERE job_id = ?');
                                            $q->execute([$row['id']]);
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
                                        <div class="col-md-auto">
                                            <div class="d-flex align-items-center gap-4">
                                                <div>
                                                    <a href="edit-job.php?id=<?= $row['id'] ?>" class="btn btn-blue">Edit Posting</a>
                                                </div>
                                                <div>
                                                    <div class="dropdown">
                                                        <a class="link-dark text-decoration-none" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fi fi-bs-menu-dots fs-4"></i>
                                                        </a>

                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="manage-job.php?id=<?= $row['id'] ?>">Manage</a></li>
                                                            <li><a class="dropdown-item" href="delete-job.php?id=<?= $row['id'] ?>">Delete Posting</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include '../includes/scripts.php' ?>
    <script>
        $(function() {
            let table = new DataTable('#table');
        })
    </script>
</body>

</html>