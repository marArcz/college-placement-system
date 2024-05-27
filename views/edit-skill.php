<?php include '../includes/auth.php' ?>
<?php include '../app/edit-skill.php' ?>
<?php
if (!isset($_GET['id'])) {
    Session::redirectTo('manage-profile.php');
    exit;
}
$id = $_GET['id'];
$query = $pdo->prepare("SELECT * FROM skills WHERE id = ?");
$query->execute([$id]);

$skill = $query->fetch();

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
                <i class="fi fi-br-arrow-small-left fs-3 w-auto"></i>
            </a>
            <p class="fs-4 fw-semibold mt-3 mb-3">Edit skill</p>
            <form action="" method="post">
                <div class="mt-3 mb-3">
                    <label for="" class="form-label">Skill name<span class="text-danger fs-4">*</span></label>
                    <input type="text" class="form-control" value="<?= $skill['name'] ?>" name="name" required>
                </div>
                <div class=" mb-3">
                    <label for="" class="form-label">Years of experience <span class="text-danger fs-4">*</span></label>
                    <select name="years_exp" class="form-select" required>
                        <option value=""></option>
                        <option <?= $skill['years_exp'] == 'Less than 1 year'? 'selected':'' ?> value="Less than 1 year">Less than 1 year</option>
                        <?php for($x=1;$x<=10;$x++): ?>
                            <option <?= $skill['years_exp'] == ($x .' '. ($x > 1?'years':'year'))? 'selected':'' ?> value="<?= $x .' '. ($x > 1?'years':'year') ?>"><?= $x .' '. ($x > 1?'years':'year') ?></option>
                        <?php endfor ?>
                    </select>
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