<?php
require_once "../../conf.php";

if(!Me::isLoggedIn()){
    http_response_code(403);
    exit("Error: User not logged in");
}

$product_id = POST("product_id", true);

if(!Cart::AddToCart((int) $product_id)) {
    http_response_code(400);
    exit("Error: Product not found");
}

http_response_code(302);
header("Location: /cart.php");