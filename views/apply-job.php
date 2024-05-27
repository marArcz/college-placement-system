<?php include '../includes/auth.php' ?>
<?php include '../app/apply-job.php' ?>
<?php
if (!isset($_GET['id'])) {
    Session::redirectTo('jobs.php');
}

$query = $pdo->prepare("SELECT * FROM jobs WHERE id=?");
$query->execute([$_GET['id']]);

$job = $query->fetch();

$section = isset($_GET['sec']) ? $_GET['section'] : 'profile';


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
            <span class="fs-5 fw-bold">Applying for a job</span>
        </div>
    </div>

    <div class="container mt-4 mb-3">
        <div class="col-md-7 mx-auto">

            <!-- content -->
            <div id="profile" class="">
                <a href="jobs.php" class=" text-decoration-none">
                    <i class="fi fi-br-arrow-small-left fs-3"></i>
                </a>
                <form action="" method='post'>
                    <p class="fs-4 fw-bold">Your profile will be submitted</p>
                    <div class="card border rounded-3 border-blue shadow-sm">
                        <div class="card-body p-lg-4">
                            <div class="d-flex">
                                <div>
                                    <p class="fw-bold fs-6 mb-1"><?= $user['firstname'] . ' ' . $user['lastname'] ?></p>
                                    <p class="mb-1"><?= $user['email'] ?></p>
                                    <p class="mb-1"><?= $user['phone'] ?></p>
                                    <p class="mb-1"><?= $user['address'] ?></p>
                                </div>
                                <div class="ms-auto">
                                    <i class="fi fi-sr-check-circle text-blue fs-3"></i>
                                </div>
                            </div>

                            <div class="mt-3">
                                <?php
                                $query = $pdo->prepare("SELECT * FROM resume_summaries WHERE resume_id IN (SELECT id FROM resumes WHERE student_id = ?)");
                                $query->execute([$user['id']]);
                                $summary = $query->fetch();
                                ?>
                                <p class="fs-6 fw-bold mb-1">Summary</p>
                                <p class="d-none" id="summary-content"><?= $summary ? $summary['summary'] : 'Nothing added yet.' ?></p>
                                <div class="border-0" id="quill-display"></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="edit-profile-for-application.php?id=<?= $job['id'] ?>" class="col-12 btn btn-light border fw-semibold ">
                                <i class="fi fi-sr-pencil"></i>
                                <span>Edit Profile</span>
                            </a>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-blue col-12 mt-4">Continue</button>
                </form>
            </div>
        </div>
    </div>
    <?php include '../includes/scripts.php' ?>
    <script>
        const handleSectionChange = () => {
            $(".section").each((i, elem) => $(elem).addClass('d-none'));
            let section = window.location.hash;
            $(section).removeClass('d-none')
        }

        $(window).on('hashchange', handleSectionChange);

        $(function() {
            const quill = new Quill("#quill-display", {
                theme: 'snow',
                readOnly: true,
                modules: {
                    toolbar: false,
                },
            })
            quill.setContents(JSON.parse($("#summary-content").html()))
            handleSectionChange();
        })
    </script>
</body>

</html>