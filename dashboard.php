<?php
include("config/config.php");
$config = new Config();

$result = $config->fetchAllStudents();
// while ($data = mysqli_fetch_assoc($result)) {
//     print_r($data);
//     echo "<br>";
// }

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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
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
                                <button class="btn btn-warning">EDIT</button>
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