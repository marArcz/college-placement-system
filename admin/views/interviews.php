<?php require '../includes/auth.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interviews | Admin</title>
    <?php include '../includes/header.php' ?>
</head>

<body class="dashboard">
    <?php $current_page = 'interviews' ?>
    <?php $header = 'Interviews' ?>
    <?php include '../includes/navbar.php' ?>
    <main class="pt-4">
        <div class="container">
            <div class="d-flex">
                <div>
                    <p class="fw-semibold fs-5 my-0">Scheduled Interviews</p>
                </div>
            </div>
            <div class="mt-2 mb-3">

                <?php
                $query = $pdo->prepare("SELECT * FROM interviews ORDER BY id DESC");
                $query->execute();
                $interviews = $query->fetchAll();
                ?>
                <?php if ($interviews) : ?>
                    <?php
                    foreach ($interviews as $interview) {
                        $q = $pdo->prepare("SELECT students.firstname, students.lastname,jobs.title,job_applications.* FROM job_applications INNER JOIN students ON job_applications.student_id = students.id INNER JOIN jobs ON job_applications.job_id = jobs.id WHERE job_applications.id = ?");
                        $q->execute([$interview['application_id']]);
                        $application = $q->fetch();
                    ?>
                        <div class="card mb-2 border shadow-sm">
                            <div class="card-body p-lg-4">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <p class="mb-1 fs-6 fw-bold"><?= $application['firstname'] . ' ' . $application['lastname'] ?></p>
                                        <p class="mb-1 fw-medium">For <?= $application['title'] ?></p>
                                        <p class="fw-semibold fs-6 text-blue mb-1">Schedule - <?= date('M d, Y', strtotime($interview['date'])) ?></p>
                                        <p class="mb-0 badge bg-light-blue fw-medium text-capitalize"><?= $interview['type'] ?></p>
                                    </div>
                                    <div class="col-md-auto text-end ms-auto">
                                        <div class="d-flex align-items-center gap-4">
                                            <div>
                                                <div class="dropdown">
                                                    <a class="btn btn-blue text-decoration-none dropdown-toggle text-capitalize" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span><?= $interview['status'] ?></span>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="../app/update-interview.php?id=<?= $interview['id'] ?>&status=completed">Completed</a></li>
                                                        <li><a class="dropdown-item" href="../app/update-interview.php?id=<?= $interview['id'] ?>&status=cancelled">Cancelled</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                <?php else : ?>
                    <p class="mb-0">No scheduled interviews.</p>
                <?php endif ?>

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