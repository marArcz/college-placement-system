<?php require '../includes/auth.php' ?>
<?php include '../app/edit-profile.php' ?>
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
    <?php $header = 'Edit Profile' ?>
    <?php include '../includes/navbar.php' ?>
    <main class="pt-4">
        <div class="container">
            <div class="col-md-8 mx-auto">
                <a href="profile.php" class=" text-decoration-none">
                    <i class="fi fi-br-arrow-small-left fs-3 w-auto"></i>
                </a>
                <p class="mt-2 fs-4 fw-semibold">Edit Profile</p>

                <div class="mt-3">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Firstname</label>
                            <input type="text" class="form-control" name="firstname" value="<?= isset($_POST['firstname'])?$_POST['firstname']:$user['firstname'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Lastname</label>
                            <input type="text" class="form-control" name="lastname" value="<?= isset($_POST['lastname'])?$_POST['lastname']:$user['lastname'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" value="<?= isset($_POST['email'])?$_POST['email']:$user['email'] ?>" required>
                            <?php if(isset($error['email'])): ?>
                                <p class="my-0 text-danger"><?= $error['email'] ?></p>
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