<?php require '../includes/auth.php' ?>
<?php include '../app/schedule-interview.php' ?>
<?php
if (!isset($_GET['id'])) {
    Session::redirectTo("jobs.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Admin</title>
    <?php include '../includes/header.php' ?>
</head>

<body class="dashboard">
    <?php $current_page = 'interviews' ?>
    <?php $header = 'Schedule an interview' ?>
    <?php include '../includes/navbar.php' ?>
    <div class="container py-3">
        <!-- calendar -->
        <form action="" method="post">
            <div>
                <a href="view-application.php?id=<?= $_GET['id'] ?>" class=" text-decoration-none">
                    <i class="fi fi-br-arrow-small-left fs-3"></i>
                </a>
            </div>
            <!-- <p class="fs-5 fw-semibold">Schedule Job Interview</p> -->
            <div class="col-md-11 mx-auto">
                <p class="text-center fw-medium text-blue"> <i class="fi fi-sr-settings"></i> Choose date and time:</p>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <p class="text-center fw-semibold">Date:</p>
                        <div id="calendar"></div>
                        <input type="hidden" value="<?= date('Y-m-d') ?>" name="date" id="date-input">
                    </div>
                    <div class="col-md">
                        <p class="text-center fw-semibold">Time & Interview type:</p>
                        <hr>
                        <input type="time" class="form-control" name="time" required>
                        <div class="mt-3">
                            <select name="type" class="form-select" required>
                                <option value="">Interview type</option>
                                <option value="phone">Phone</option>
                                <option value="online">Online</option>
                                <option value="in-person">In-person</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-3 text-end">
                    <a href="view-application.php?id=<?= $_GET['id'] ?>" class="btn btn-secondary fw-medium px-4">Cancel</a>
                    <button class="btn btn-blue fw-medium px-4" type="submit" name="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <?php include '../includes/scripts.php' ?>
    <script>
        $(function() {
            var myCalendar = new Calendar({
                element: "#calendar",
                activeColor: '#245FAE',
            })

            function formatDate(date) {
                const year = date.getFullYear().toString().padStart(4, '0');
                const month = (date.getMonth() + 1).toString().padStart(2, '0');
                const day = date.getDate().toString().padStart(2, '0');

                return `${year}-${month}-${day}`;
            }

            myCalendar.createCalendar()
            myCalendar.setOnSelectDate(function(date) {
                $('#date-input').val(formatDate(date))
                // console.log()
            })
        })
    </script>
</body>

</html>