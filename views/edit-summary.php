<?php include '../includes/auth.php' ?>
<?php include '../app/edit-summary.php' ?>
<?php
if (!isset($_GET['s'])) {
    Session::redirectTo('manage-profile.php');
    exit;
}
$summary_id = $_GET['s'];

$query = $pdo->prepare("SELECT * FROM resume_summaries WHERE id = ?");
$query->execute([$summary_id]);

$summary = $query->fetch();

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
            <i class="fi fi-sr-user-skill-gear fs-3"></i>
            <span class="fs-5 fw-bold">Manage Profile</span>
        </div>
    </div>

    <div class="container mt-3">
        <!-- content -->
        <div class="col-md-8 mx-auto">
            <a href="manage-profile.php" class=" text-decoration-none">
                <i class="fi fi-br-arrow-small-left fs-3"></i>
            </a>
            <p class="fs-4 fw-semibold mt-3">Edit Summary</p>
            <form action="" method="post">
                <div class="mt-3 mb-3">
                    <!-- <textarea name="summary" class="form-control" rows="3" id="editor"></textarea> -->
                    <p class="d-none" id="summary-text"><?= $summary['summary'] ?></p>
                    <div id="editor" class="fs-6">
                    </div>
                    <input type="hidden" name="summary" id="summary-box">
                </div>

                <div class="mt-3">
                    <button type="submit" name="submit" class="btn btn-blue fs-6 fw-bold py-2">Save</button>
                </div>
            </form>
        </div>
    </div>
    <?php include '../includes/scripts.php' ?>
    <script>
        $(function() {
            var quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
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
                    $("#summary-box").val(JSON.stringify(quill.getContents()))
                }
            });

            quill.setContents(JSON.parse($("#summary-text").html()))
        })
    </script>
</body>

</html>