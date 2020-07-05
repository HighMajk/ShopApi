<?php
require_once "../../conf.php";

if(!Me::IsLoggedIn()) {
    http_response_code(403);
    exit("Error: User not logged in");
}

$product_id = POST("product_id", true);

Cart::RemoveFromCart((int) $product_id);

http_response_code(302);
header("Location: /cart.php");