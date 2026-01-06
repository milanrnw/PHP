<?php
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include("../config/config.php");
$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $res = $config->loginUser($email, $password);

        if ($res) {
            http_response_code(200);
            $arr['status'] = 200;
            $arr['is_error'] = false;
            $arr['msg'] = "User Login Successfully...";
        } else {
            http_response_code(401);
            $arr['status'] = 401;
            $arr['is_error'] = true;
            $arr['msg'] = "Invalid email or password";
        }
    } else {
        http_response_code(400);
        $arr['status'] = 400;
        $arr['is_error'] = true;
        $arr['msg'] = "Email and password are required";
    }
} else {
    http_response_code(405);
    $arr['status'] = 405;
    $arr['is_error'] = true;
    $arr['msg'] = "POST HTTP Request Method Allowed Only";
}

echo json_encode($arr);
?>