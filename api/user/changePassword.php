<?php
require_once "../../conf.php";

if(!Me::isLoggedIn()){
    http_response_code(403);
    exit("Error: User not logged in");
}

$current_password = POST("current_password", true, false);
$password = POST("password", true, false);
$confirm_password = POST("confirm_password", true, false);

if($password !== $confirm_password) {
    http_response_code(400);
    exit("ERROR: password and confirm password don't match");
}

if(!Me::GetUser()->ChangePassword($current_password, $password,$err_message)) {
    http_response_code(400);
    exit("Error: {$err_message}");
}

http_response_code(302);
header("Location: /user/settings.php");