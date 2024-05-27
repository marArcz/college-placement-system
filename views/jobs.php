<?php include '../includes/auth.php' ?>
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
        <div class="d-flex align-items-center justify-content-center py-3 text-white gap-3">
            <i class="fi fi-sr-briefcase d-flex fs-5 "></i>
            <span class="fs-5 fw-bold">Jobs</span>
        </div>
    </div>

    <div class="container mt-3">
        <!-- content -->
        <div class="col-md-7 mx-auto">
            <form action="" method="get">
                <div class="search-field">
                    <div class="search-wrapper">
                        <i class="search-icon fi fi-rr-search"></i>
                        <input type="search" name="keyword" value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>" placeholder="Job title, keywords or company">
                    </div>
                    <div class="btn-wrapper">
                        <button type="submit" class="btn btn-blue">Find jobs</button>
                    </div>
                </div>
            </form>
            <?php if (isset($_GET['keyword']) && !empty($_GET['keyword'])) : ?>
                <p class="text-secondary mt-3">
                    <?= $_GET['keyword'] ?> jobs
                </p>
                <?php $is_searching = true ?>
            <?php else : ?>
                <?php $is_searching = false ?>
            <?php endif ?>
            <!-- jobs -->
            <div class="mt-3">
                <?php
                if ($is_searching) {
                    $keyword = '%' . $_GET['keyword'] . '%';
                    $query = $pdo->prepare("SELECT * FROM jobs WHERE deadline > NOW() AND status = 'open' AND (title LIKE :search || company LIKE :search || job_type LIKE :search || `description` LIKE :search) ORDER BY id DESC");
                    $query->execute([
                        ':search' => $keyword
                    ]);
                } else {
                    $query = $pdo->query("SELECT * FROM jobs WHERE deadline > NOW() AND status = 'open' ORDER BY id DESC");
                }
                $jobs = $query->fetchAll();
                ?>

                <?php foreach ($jobs as $row) : ?>
                    <a href="view-job.php?id=<?= $row['id'] ?>" class=" text-decoration-none">
                        <div class="card rounded-3 shadow-sm border mb-3">
                            <div class="card-body">
                                <p class="mb-1 fw-semibold"><?= $row['title'] ?></p>
                                <p class="mb-1 fw-medium"><?= $row['company'] ?></p>
                                <p class="fw-light text-capitalize mb-2"><?= $row['job_type'] ?> | <span class="text-success"><?= $row['salary_range'] ?></span></p>
                                <?php if ($row['deadline']) : ?>
                                    <p class="mb-0 form-text">Application deadline - <?= date('M d, Y', strtotime($row['deadline'])) ?></p>
                                <?php endif ?>
                                <p class="form-text text-secondary">
                                    Date posted - <?= date('M d, Y', strtotime($row['posting_date'])) ?>
                                </p>
                            </div>
                        </div>
                    </a>
                <?php endforeach ?>
                <?php if (count($jobs) == 0) : ?>
                    <p class="text-center fs-5 text-secondary">
                        No jobs to show.
                    </p>
                <?php endif ?>
            </div>
        </div>

    </div>
    <?php include '../includes/scripts.php' ?>
</body>

</html>