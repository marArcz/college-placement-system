<?php require '../includes/auth.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Admin</title>
    <?php include '../includes/header.php' ?>
</head>

<body class="dashboard">
    <?php $current_page = 'jobs' ?>
    <?php $header = 'Jobs' ?>
    <?php include '../includes/navbar.php' ?>
    <main class="pt-4">
        <div class="container">

            <div class="mt-2">
                <div class="card rounded-3 border-0 shadow-sm">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="my-0 fw-bold text-dark">Jobs</p>
                            </div>
                            <a href="add-job.php" class="btn btn-blue d-flex align-items-center ms-auto fw-semibold py-2">
                                <i class="fi fi-sr-plus fs-6 d-flex me-3"></i>
                                <span>Add</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table" id="table">
                                <thead>
                                    <tr>
                                        <th>Job title</th>
                                        <th>Description</th>
                                        <th>Company</th>
                                        <th>Location</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $query = $pdo->prepare("SELECT * FROM jobs");
                                        $query->execute();
                                        while($row = $query->fetch()){
                                            ?>
                                            <tr>
                                                <td><?= $row['title'] ?></td>
                                                <td><?= $row['description'] ?></td>
                                                <td><?= $row['company'] ?></td>
                                                <td><?= $row['location'] ?></td>
                                                <td class=" text-capitalize"><?= $row['job_type'] ?></td>
                                                <td class=" text-capitalize"><?= $row['status'] ?></td>
                                                <td>
                                                    <a href="edit-job.php?id=<?= $row['id'] ?>" class="link-success">Edit</a>
                                                    <a href="delete-job.php?id=<?= $row['id'] ?>" class="link-danger">Delete</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
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