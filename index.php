<?php
include("config/config.php");
$config = new config();

$res = $config->connectDB();

if ($res) {
    echo "<h2> DATABASE SUCCESSFULLY CONNECTED! </h2>";
} else {
    echo "<h2> UNABLE TO CONNECT DATABASE. </h2>";
}

/*
super global variable
Use this as per the method you use in your form but request is compatible with both.
$_GET
$_POST
$_REQUEST
@ => error control operator / ignores warning.
*/

if (isset($_REQUEST["btn_submit"])) {
    $name = @$_POST["name"];
    $age = @$_POST["age"];
    $course = @$_POST["course"];

    echo "<br> Name: $name <br>";
    echo "Age: $age <br>";
    echo "Course: $course <br>";
}
?>

<html>

<head>
    <title>Student Form</title>
</head>

<body>
    <a href="index.php">Home</a> | <a href="success.php">SuccessPage</a>
    <center>
        <h1>Add Student</h1>

        <form method="POST">

            <label>Name</label>
            <input type="text" name="name" required>
            <br> <br>
            <label>Age</label>
            <input type="number" name="age" required>
            <br> <br>
            <label>Course</label>
            <input type="text" name="course" required>
            <br> <br>
            <button name="btn_submit">Add Student</button>

        </form>
    </center>

</body>

</html>