<?php
require_once "../../conf.php";

if(!Me::isLoggedIn()){
    http_response_code(403);
    exit("Error: User already logged out");
}

Session::DestroySessionByUser(Me::GetUser()->GetData()["id"]);

http_response_code(302);
header("Location: ../../auth/login.php");
