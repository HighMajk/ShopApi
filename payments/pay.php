<?php
require_once "../conf.php";

if(!Me::isLoggedIn()){
    http_response_code(403);
    exit("Error: User not logged in");
}

?>
<!doctype html >
<html lang = "en" >
<head >
    <title>Home</title >
    <?php require_once BASE_DIR . "/template/header.php" ?>
</head >
<body>
    <?php
    $final_price = 0;
    /* add function change supply price */
    $supply_price = 12.99;

    foreach(Cart::GetProducts() as $product){
        $final_price += $product->GetData()["price"];
        ?>
        <div class="media media-cart">
            <img class="product-cart-img img-thumbnail mr-3" src="<?=$product->GetData()["icon_url"]?>" alt="product icon">
            <div class="media-body media-body-cart">
                <h5 class="mt-2"><?=$product->GetData()["title"]?></h5>
                <h5 class="media-body-cart-price text-dark"><?=$product->GetData()["price"]?> zł</h5>
            </div>
        </div>

        <?php
        $cart = true;
    }
    if(!isSet($cart)){
        echo "<h5 class='text-secondary text-center mb-5 mt-5'>Rachunek jest pusty.</h5>";
    }

    $final_price += $supply_price;
    $orderNo = date ('dmYHis').rand(0000,9999);

    echo "Numer rachunku: ".$orderNo."<br />";
    echo "Cena do zapłaty: ".$final_price."<br /><br />";

    $ParametersArray = array(

        "api_version" => "dev",
        "amount" => "$final_price",
        "currency" => "PLN",
        "description" => "Numer zamówienia: $orderNo",
        "url" => "http://217.96.255.90:8080/store.php",
        "type" => "0",
        "buttontext" => "wróć do sklepu E-AlCo",
        "urlc" => URLC,
        "control" => $orderNo,
        "firstname" => "Jan",
        "lastname" => "Nowak",
        "email" => "jan.nowak@example.com",
        "street" => "Warszawska",
        "street_n1" => "1",
        "city" => "Krakow",
        "postcode" => "12-345",
        "phone" => "123456789",
        "country" => "POL",
        "ignore_last_payment_channel" => 1
    );

    Payment::addPayment(DOTPAYID,DOTPAYIP,$ParametersArray ,$orderNo, $final_price);

    ## CALCULATE CHECKSUM - CHK


    ##  get form (POST method) or payment link (GET method)
    ##  ("Dotpay ID","PIN","[test|production]","[POST|GET]","payment data")

    echo Payment::GenerateChkDotpayRedirection(DOTPAYID, DOTPAYPIN, ENVIRONMENT, REDIRECTIONMETHOD , $ParametersArray);
    ?>
</body>

<?php require_once BASE_DIR . "/template/footer.php"; ?>

</body >
</html >
