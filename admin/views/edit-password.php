<?php require '../includes/auth.php' ?>
<?php include '../app/edit-password.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Admin</title>
    <?php include '../includes/header.php' ?>
</head>

<body class="dashboard bg-white">
    <?php $current_page = 'profile' ?>
    <?php $header = 'Change Password' ?>
    <?php include '../includes/navbar.php' ?>
    <main class="pt-4">
        <div class="container">
            <div class="col-md-8 mx-auto">
                <a href="profile.php" class=" text-decoration-none">
                    <i class="fi fi-br-arrow-small-left fs-3 w-auto"></i>
                </a>
                <p class="mt-2 fs-4 fw-semibold">Change Password</p>

                <div class="mt-3">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Current Password</label>
                            <input type="password" class="form-control" name="current_pass" value="<?= isset($_POST['current_pass'])?$_POST['current_pass']:'' ?>" required>
                            <?php if(isset($error['current_pass'])): ?>
                                <p class="my-0 text-danger"><?= $error['current_pass'] ?></p>
                            <?php endif ?>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">New Password</label>
                            <input type="password" class="form-control" name="new_pass" required>
                            <?php if(isset($error['new_pass'])): ?>
                                <p class="my-0 text-danger"><?= $error['new_pass'] ?></p>
                            <?php endif ?>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_pass"  required>
                            <?php if(isset($error['new_pass'])): ?>
                                <p class="my-0 text-danger"><?= $error['new_pass'] ?></p>
                            <?php endif ?>
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
                    ['bold','italic'],
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
    </script>
</body>

</html>