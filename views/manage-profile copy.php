<?php include '../includes/auth.php' ?>
<?php
$active_section_key = isset($_GET['section']) ? $_GET['section'] : 'personal';

// check if user have no resume yet
$query = $pdo->prepare("SELECT * FROM resumes WHERE student_id = ?");
$query->execute([$user['id']]);

if ($query->rowCount() == 0) {
    $query = $pdo->prepare("INSERT INTO resumes(student_id,last_section) VALUES(?,?)");
    $query->execute([$user['id'], 'personal']);
}
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
        <div class="row g-2">
            <div class="col-md-2">
                <div class="card border shadow-sm h-100">
                    <div class="card-body py-lg-4">
                        <p class="fw-semibold">Sections</p>
                        <ul class="nav gap-2 section-nav">
                            <?php
                            $sections = [
                                [
                                    'title' => 'Personal Info',
                                    'key' => 'personal',
                                    'icon' => '<i class="fi fi-sr-user"></i>'
                                ],
                                [
                                    'title' => 'Experience',
                                    'key' => 'experience',
                                    'icon' => '<i class="fi fi-sr-file"></i>'
                                ],
                                [
                                    'title' => 'Education',
                                    'key' => 'educ',
                                    'icon' => '<i class="fi fi-sr-graduation-cap"></i>'
                                ],
                                [
                                    'title' => 'Skills',
                                    'key' => 'skills',
                                    'icon' => '<i class="fi fi-sr-tools"></i>'
                                ],
                            ];
                            ?>
                            <?php foreach ($sections as $section) : ?>
                                <?php
                                $disabled = true;
                                if ($section['key'] == 'personal') {
                                    $disabled = false;
                                } else if ($section['key'] == 'experience') {
                                    $query = $pdo->prepare("SELECT * FROM experience_sections WHERE resume_id = ?");
                                }
                                ?>
                                <li class="nav-item w-100">
                                    <a href="" class="nav-link  <?= $disabled ? 'disabled link-secondary' : 'link-dark' ?> <?= $active_section_key == $section['key'] ? 'active' : '' ?>">
                                        <div class="d-flex gap-2 align-items-center">
                                            <?= $section['icon'] ?>
                                            <span><?= $section['title'] ?></span>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card border shadow-sm">
                    <div class="card-body p-lg-4">
                        <p class="fw-semibold mb-4">Personal Information</p>
                        <form action="" method="post">
                            <div class="mb-3">
                                <div class="row gy-3">
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Firstname:</label>
                                        <input value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : $user['firstname'] ?>" type="text" class="form-control" name="firstname" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Lastname:</label>
                                        <input value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : $user['lastname'] ?>" type="text" class="form-control" name="lastname" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Email address:</label>
                                        <input value="<?= isset($_POST['email']) ? $_POST['email'] : $user['email'] ?>" type="text" class="form-control" name="email" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Address:</label>
                                        <input type="text" class="form-control" name="address" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Phone:</label>
                                        <input type="text" class="form-control" name="lastname" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Civil Status:</label>
                                        <select name="civil_status" class="form-select">
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Widowed">Widowed</option>
                                        </select>
                                    </div>

                                    <div class="mt-5 text-end">
                                        <button type="submit" name="personal_info" class="btn btn-primary">Next</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/scripts.php' ?>
</body>

</html>