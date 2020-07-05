<?php
require_once "../../conf.php";

if(!Me::isLoggedIn()){
    http_response_code(403);
    exit("Error: User not logged in");
}

$email = POST("email", true);

if(!Me::GetUser()->ChangeEmail($email, $err_message)) {
    http_response_code(400);
    exit("Error: {$err_message}");
}

http_response_code(302);
header("Location: /user/settings.php");