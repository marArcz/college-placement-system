<?php include '../includes/auth.php' ?>
<?php include '../app/add-work-experience.php' ?>
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

    <div class="container mt-3 mb-3">
        <!-- content -->
        <div class="col-md-8 mx-auto">
            <a href="manage-profile.php" class=" text-decoration-none">
                <i class="fi fi-br-arrow-small-left fs-3"></i>
            </a>
            <p class="fs-4 fw-semibold mt-2 mb-3">Add work experience</p>
            <form action="" method="post">
                <div class="mt-3 mb-3">
                    <label for="" class="form-label">Job title <span class="text-danger fs-4">*</span></label>
                    <input type="text" class="form-control" name="job_title" required>
                </div>
                <div class=" mb-3">
                    <label for="" class="form-label">Company</label>
                    <input type="text" class="form-control" name="company" required>
                </div>
                <p class="fw-semibold">Time period</p>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="current_job" value="true" id="current-job">
                        <label class="form-check-label" for="current-job">
                            I currently work here
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">From</label>
                    <div class="row gy-3">
                        <div class="col-md">
                            <select name="month_from" class="form-select" required>
                                <option value="">Month</option>
                                <?php
                                $months = [
                                    'January',
                                    'February',
                                    'March',
                                    'April',
                                    'May',
                                    'June',
                                    'July',
                                    'August',
                                    'September',
                                    'October',
                                    'November',
                                    'December',
                                ];
                                foreach ($months as $month) {
                                ?>
                                    <option value="<?= $month ?>"><?= $month ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md">
                            <select name="year_from" class="form-select" required>
                                <option value="">Year</option>
                                <?php
                                $start_year = 1995;
                                $end_year = intval(date('Y'));
                                for ($year = $start_year; $year <= $end_year; $year++) {
                                ?>
                                    <option value="<?= $year ?>"><?= $year ?></option>
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
                            <select name="month_to" class="form-select">
                                <option value="">Month</option>
                                <?php
                                $months = [
                                    'January',
                                    'February',
                                    'March',
                                    'April',
                                    'May',
                                    'June',
                                    'July',
                                    'August',
                                    'September',
                                    'October',
                                    'November',
                                    'December',
                                ];
                                foreach ($months as $month) {
                                ?>
                                    <option value="<?= $month ?>"><?= $month ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md">
                            <select name="year_to" class="form-select">
                                <option value="">Year</option>
                                <?php
                                $start_year = 1995;
                                $end_year = intval(date('Y'));
                                for ($year = $start_year; $year <= $end_year; $year++) {
                                ?>
                                    <option value="<?= $year ?>"><?= $year ?></option>
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
        $(function(){
            $("#current-job").on('click',function(e){
                if($("#current-job")[0].checked){
                    $("#time-to").hide()
                    $("#present-text").removeClass('d-none')
                }else{
                    $("#present-text").addClass('d-none')
                    $("#time-to").show()
                }
            })
        })
    </script>
</body>

</html>