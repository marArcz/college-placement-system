<?php include '../includes/auth.php' ?>
<?php include '../app/apply-job.php' ?>
<?php
if (!isset($_GET['id'])) {
    Session::redirectTo('jobs.php');
}

$query = $pdo->prepare("SELECT * FROM jobs WHERE id=?");
$query->execute([$_GET['id']]);

$job = $query->fetch();



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
    <!-- <div class="content-header">
        <div class="d-flex align-items-center gap-3 justify-content-center py-3 text-white">
            <i class="fi fi-sr-briefcase d-flex fs-5 "></i>
            <span class="fs-5 fw-bold">Applying for a job</span>
        </div>
    </div> -->

    <div class="container mt-4 mb-3">
        <div class="col-md-9 mx-auto">

            <!-- content -->
            <div class="col-md-8 mx-auto">
                <div class="text-center">
                    <img src="../assets//images//success-lg.png" class="img-fluid mt-3" alt="">
                    <p class="fs-2 text-center mt-3 fw-semibold text-blue">Your application has been submitted !</p>
                </div>
                <div class="mt-3 text-center">
                    <p class="fs-6">
                        <i class="fi fi-sr-check-circle text-success"></i>
                        <span class="ms-1">We will send an application status update within 2 weeks</span>
                    </p>

                    <a href="jobs.php" class="mt-3 btn btn-blue">Continue job search</a>
                </div>
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