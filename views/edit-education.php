<?php include '../includes/auth.php' ?>
<?php include '../app/edit-education.php' ?>
<?php
if (!isset($_GET['id'])) {
    Session::redirectTo('manage-profile.php');
    exit;
}
$id = $_GET['id'];
$query = $pdo->prepare("SELECT * FROM educations WHERE id = ?");
$query->execute([$id]);

$education = $query->fetch();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Profile</title>
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
                <i class="fi fi-br-arrow-small-left fs-3"></i>
            </a>
            <p class="fs-4 fw-semibold mt-2 mb-3">Edit education</p>
            <form action="" method="post">
                <div class="mt-3 mb-3">
                    <label for="" class="form-label">Level of education <span class="text-danger fs-4">*</span></label>
                    <input value="<?= $education['level'] ?>" type="text" class="form-control" name="level" required>
                </div>
                <div class=" mb-3">
                    <label for="" class="form-label">School Name</label>
                    <input value="<?= $education['school'] ?>" type="text" class="form-control" name="school" required>
                </div>
                <p class="fw-semibold">Time period</p>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" <?= $education['currently_enrolled'] ? 'checked' : '' ?> type="checkbox" name="currently_enrolled" value="true" id="current-job">
                        <label class="form-check-label" for="current-job">
                            Currently enrolled
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">From</label>
                    <div class="row gy-3">
                        <div class="col-md">
                            <select name="year_from" class="form-select" required>
                                <option value="">Year</option>
                                <?php
                                $start_year = 1995;
                                $end_year = intval(date('Y'));
                                for ($year = $start_year; $year <= $end_year; $year++) {
                                ?>
                                    <option <?= $education['year_from'] == $year ? 'selected' : '' ?> value="<?= $year ?>"><?= $year ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">To</label>
                    <p id="present-text" class="d-none text-secondary fw-medium">Present</p>
                    <div class="row gy-3" id="time-to">
                        <div class="col-md">
                            <select name="year_to" class="form-select">
                                <option value="">Year</option>
                                <?php
                                $start_year = 1995;
                                $end_year = intval(date('Y'));
                                for ($year = $start_year; $year <= $end_year; $year++) {
                                ?>
                                    <option <?= $education['year_to'] == $year ? 'selected' : '' ?> value="<?= $year ?>"><?= $year ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
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

            if ($("#current-job")[0].checked) {
                $("#time-to").hide()
                $("#present-text").removeClass('d-none')
            } else {
                $("#present-text").addClass('d-none')
                $("#time-to").show()
            }
        })
    </script>
</body>

</html>