<?php
include("config/config.php");
$config = new config();
$res = $config->connectDB();

//insert student
if (isset($_REQUEST["btn_submit"])) {
    $name = @$_POST["name"];
    $age = @$_POST["age"];
    $course = @$_POST["course"];

    $resSTUD = $config->insertStudent($name, $age, $course);

    if ($resSTUD) {
        echo '<div class="container col-6 mt-2">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>success! </strong>Student Inserted successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed!</strong>Student insertion failed.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}

//Fetch students
$result = $config->fetchAllStudents();

//Delete student
if (isset($_POST['btn-delete'])) {
    $deleteId = $_POST['delete_id'];
    $res = $config->deleteStud($deleteId);

    if ($res) {
        echo '<div class="container col-6 mt-2">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>success! </strong>Student deleted successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        </div>';
        $result = $config->fetchAllStudents();
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed!</strong>Student deletion failed.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}

$updateStud = NULL;
//Update student info
if (isset($_REQUEST['btn_edit'])) {
    $update_id = $_REQUEST['update_id'];
    $singleStud = $config->fetchSingleStudent($update_id);
    $updateStud = mysqli_fetch_assoc($singleStud);
}
if (isset($_REQUEST['btn-update'])) {
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $age = $_REQUEST['age'];
    $course = $_REQUEST['course'];

    $res = $config->updateStudent($name, $age, $course, $id);
    if ($res) {
        echo '<div class="container col-6 mt-2">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>success! </strong>Student info updated successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        </div>';
        $result = $config->fetchAllStudents();
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed!</strong>Student updation failed.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}
?>

<html>

<head>
    <title>Student Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: teal;
            color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: teal;">
        <div class="container">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="col-4">
            <h1><?php if ($updateStud == NULL) {
                echo "ADD";
            } else {
                echo "UPDATE";
            } ?> STUDENT</h1>

            <form method="POST" class="pt-2">

                <label>Name</label>
                <input type="hidden" name="id" value="<?php if ($updateStud != NULL) {
                    echo $updateStud['id'];
                } ?>" class="form-control" style="background-color: #e0f2f1;" required> <br>
                <br>
                <input type="text" name="name" value="<?php if ($updateStud != NULL) {
                    echo $updateStud['name'];
                } ?>" class="form-control" style="background-color: #e0f2f1;" required> <br>
                <br>
                <label>Age</label>
                <input type="number" name="age" value="<?php if ($updateStud != NULL) {
                    echo $updateStud['age'];
                } ?>" class="form-control" style="background-color: #e0f2f1;" required>
                <br> <br>
                <label>Course</label>
                <input type="text" name="course" value="<?php if ($updateStud != NULL) {
                    echo $updateStud['course'];
                } ?>" class="form-control" style="background-color: #e0f2f1;" required>
                <br> <br>
                <button name="<?php if ($updateStud == NULL) {
                    echo "btn_submit";
                } else {
                    echo "btn-update";
                } ?>" class="btn <?php if ($updateStud == NULL) {
                     echo "btn-primary";
                 } else {
                     echo "btn-warning";
                 } ?>"><?php if ($updateStud == NULL) {
                      echo "Add";
                  } else {
                      echo "Update";
                  } ?> Student</button>

            </form>
        </div>
        <div class="col-8">
            <table class="table  table-light table-hover text-center table-bordered border-dark">
                <thead class="text-center table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col">AGE</th>
                        <th scope="col">COURSE</th>
                        <th scope="col " colspan="2">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($data = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <th scope="row" style="background-color: teal !important;"><?php echo $data['id'] ?></th>
                            <td style="background-color: teal !important;"><?php echo $data['name'] ?></td>
                            <td style="background-color: teal !important;"><?php echo $data['age'] ?></td>
                            <td style="background-color: teal !important;"><?php echo $data['course'] ?></td>
                            <td style="background-color: teal !important;">
                                <form method="POST">
                                    <button name="btn-delete" class="btn btn-danger">DELETE</button>
                                    <input type="hidden" name="delete_id" value="<?php echo $data['id'] ?>">
                                </form>

                            </td>
                            <td style="background-color: teal !important;">
                                <form method="post">
                                    <input type="hidden" name="update_id" value="<?php echo $data['id'] ?>">
                                    <button name="btn_edit" class="btn btn-warning">EDIT</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>