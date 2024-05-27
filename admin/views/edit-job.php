<?php require '../includes/auth.php' ?>
<?php include '../app/edit-job.php' ?>
<?php
if (!isset($_GET['id'])) {
    Session::redirectTo('jobs.php');
}

$query = $pdo->prepare("SELECT * FROM jobs WHERE id = ?");
$query->execute([$_GET['id']]);

$job = $query->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Job | Admin</title>
    <?php include '../includes/header.php' ?>
</head>

<body class="dashboard bg-white">
    <?php $current_page = 'job' ?>
    <?php $header = 'Posting a job' ?>
    <?php include '../includes/navbar.php' ?>
    <main class="pt-4">
        <div class="container">
            <div class="col-md-8 mx-auto">
                <a href="jobs.php" class=" text-decoration-none">
                    <i class="fi fi-br-arrow-small-left fs-3 w-auto"></i>
                </a>
                <p class="mt-2 fs-4 fw-semibold">Edit job</p>

                <div class="mt-3">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Job title</label>
                            <input value="<?= $job['title'] ?>" type="text" class="form-control" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Company name</label>
                            <input value="<?= $job['company'] ?>" type="text" class="form-control" name="company" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Location</label>
                            <input value="<?= $job['location'] ?>" type="text" class="form-control" name="location" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Job Type</label>
                            <select name="job_type" class="form-select">
                                <option value=""></option>
                                <?php
                                $job_types = ['Full-time', 'Part-time', 'Internship'];
                                foreach ($job_types as $job_type) {
                                ?>
                                    <option <?= $job['job_type'] == strtolower($job_type) ? 'selected' : '' ?> value="<?= $job_type ?>"><?= $job_type ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Salary range</label>
                            <input value="<?= $job['salary_range'] ?>" type="text" class="form-control" name="salary_range" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Application deadline</label>
                            <input type="date" value="<?= date('Y-m-d', strtotime($job['deadline'])) ?>" name="deadline" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Job description</label>
                            <p id="description-content" class="d-none"><?= $job['description'] ?></p>
                            <div class="fs-6" id="quill-editor"></div>
                            <textarea name="description" class="d-none" id="description-box"><?= $job['description'] ?></textarea>
                        </div>
                        <div class="mt-4 mb-3">
                            <button type="submit" name="submit" class="btn btn-blue fw-semibold">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php include '../includes/scripts.php' ?>
    <script>
        var quill = new Quill('#quill-editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                ]
            },
        });

        quill.on('text-change', (delta, oldDelta, source) => {
            if (source == 'api') {
                console.log('An API call triggered this change.');
            } else if (source == 'user') {
                console.log('A user action triggered this change.');
                console.log('content: ', JSON.stringify(quill.getContents()))
                $("#description-box").val(JSON.stringify(quill.getContents()))
            }
        });

        quill.setContents(JSON.parse($("#description-content").html()));
    </script>
</body>

</html>