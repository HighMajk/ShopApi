<?php
define("BASE_DIR", "C:\\xampp\\htdocs");

// Mysqli Data Base
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "sklep");


// Auth
define("SESSION_COOKIE_NAME", "session");
define("SESSION_EXPIRE_DAYS", 30);
define("PASSWORD_HASH_ALGO", PASSWORD_DEFAULT);
// Users DB
define ("USER_USERNAME_MAX_LEN", 32);

// Session
define("TOKEN_HASH_ALGO", "sha3-256");

// DotPay
define("DOTPAYID", "730855");
define("DOTPAYPIN", "OQBVlf6Fy0qHB4aEGUVsWQLXGo9s0sos");
define("ENVIRONMENT", "test");
define("REDIRECTIONMETHOD", "POST");
define("URLC", "http://80.49.254.186:8080/api/payments/urlc_receiver.php");
define("DOTPAYIP", "195.150.9.37");

//Data Base id
$orderStatus[1] = "Oczekiwanie na zapłatę";
$orderStatus[2] = "Przyjęta do realizacji";
$orderStatus[3] = "W trakcie realizacji";
$orderStatus[4] = "Wysłana";
$orderStatus[5] = "Zrealizowana";

$paymentStatus[1] = "Oczekiwanie";
$paymentStatus[2] = "Przetwarzana";
$paymentStatus[3] = "Wykonana";
$paymentStatus[4] = "Odrzucona";
$paymentStatus[5] = "Problem z płatnością";

require_once BASE_DIR."/init.php";