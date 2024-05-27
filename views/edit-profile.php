<?php include '../includes/auth.php' ?>
<?php include '../app/edit-profile.php' ?>

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

    <div class="container mt-3 mb-3">
        <!-- content -->
        <div class="col-md-8 mx-auto">
            <a href="manage-profile.php" class=" text-decoration-none">
                <i class="fi fi-br-arrow-small-left fs-3 w-auto"></i>
            </a>
            <p class="fs-4 fw-semibold mt-3 mb-3">Contact Information</p>
            <form action="" method="post">
                <div class="mt-3 mb-3">
                    <label for="" class="form-label">Firstname<span class="text-danger fs-4">*</span></label>
                    <input type="text" class="form-control" value="<?= isset($_POST['firstname'])?$_POST['firstname']:$user['firstname'] ?>" name="firstname" required>
                </div>
                <div class="mt-3 mb-3">
                    <label for="" class="form-label">Lastname<span class="text-danger fs-4">*</span></label>
                    <input type="text" class="form-control" value="<?= isset($_POST['lastname'])?$_POST['lastname']:$user['lastname'] ?>" name="lastname" required>
                </div>
                <div class="mt-3 mb-3">
                    <label for="" class="form-label">Email<span class="text-danger fs-4">*</span></label>
                    <input type="email" class="form-control" value="<?= isset($_POST['email'])?$_POST['email']:$user['email'] ?>" name="email" required>
                    <?php if (isset($error['email'])) : ?>
                        <p class="text-danger fw-semibold form-text px-2"><?= $error['email'] ?></p>
                    <?php endif ?>
                </div>
                <div class="mt-3 mb-3">
                    <label for="" class="form-label">Phone<span class="text-danger fs-4">*</span></label>
                    <input type="number" class="form-control" value="<?= isset($_POST['phone'])?$_POST['phone']:$user['phone'] ?>" name="phone" required>
                    <?php if (isset($error['phone'])) : ?>
                        <p class="text-danger fw-semibold form-text px-2"><?= $error['phone'] ?></p>
                    <?php endif ?>
                </div>
                <div class="mt-3 mb-3">
                    <label for="" class="form-label">Address<span class="text-danger fs-4">*</span></label>
                    <input type="text" class="form-control" value="<?= isset($_POST['address'])?$_POST['address']:$user['address'] ?>" name="address" required>
                    <?php if (isset($error['address'])) : ?>
                        <p class="text-danger fw-semibold form-text px-2"><?= $error['address'] ?></p>
                    <?php endif ?>
                </div>
                <div class="mt-4">
                    <button type="submit" name="submit" class="btn btn-blue fs-6 fw-bold py-2">Save</button>
                </div>
            </form>
        </div>
    </div>
    <?php include '../includes/scripts.php' ?>
    <script>
        $(function() {
            $("#current-job").on('click', function(e) {
                if ($("#current-job")[0].checked) {
                    $("#time-to").hide()
                    $("#present-text").removeClass('d-none')
                } else {
                    $("#present-text").addClass('d-none')
                    $("#time-to").show()
                }
            })
        })
    </script>
</body>

</html>