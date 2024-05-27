<?php include '../includes/auth.php' ?>
<?php include '../app/add-personal-info.php' ?>
<?php
if (!isset($_GET['id'])) {
    Session::redirectTo('manage-profile.php');
    exit;
}
$resume_id = $_GET['id'];

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
            <p class="fs-4 fw-semibold mt-2 mb-3">Personal Information</p>
            <form action="" method="post">
                <div class="mt-3 mb-3">
                    <label for="" class="form-label">Citizenship:</label>
                    <input type="text" class="form-control" name="citizenship" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Civil Status:</label>
                    <select name="civil_status" class="form-select" required>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Widowed">Widowed</option>
                    </select>
                </div>
                <div class="">
                    <button type="submit" name="submit" class="btn btn-blue fs-6 fw-bold py-2">Save</button>
                </div>
            </form>
        </div>
    </div>
    <?php include '../includes/scripts.php' ?>
    <script>

    </script>
</body>

</html>