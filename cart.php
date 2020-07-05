<?php
require_once "conf.php";

if(!Me::isLoggedIn()){
    http_response_code(403);
    exit("Error: User not logged in");
}
?>
<!doctype html >
<html lang = "en" >
<head >
    <title>Home</title >
    <?php require_once BASE_DIR."/template/header.php"?>
</head >
<body>
    <?php require_once BASE_DIR."/template/navbar.php";?>
    <div class="container">
        <div class="content bg-light p-4">
            <div class="row ">
                <div class="col-lg-8 col-md-12 mb-3">
                    <div class="p-3 bg-white">
                        <?php
                        $final_price = 0;
                        foreach(Cart::GetProducts() as $product){
                            $final_price += $product->GetData()["price"];
                            ?>
                            <div class="media media-cart">
                                <img class="product-cart-img img-thumbnail mr-3" src="<?=$product->GetData()["icon_url"]?>" alt="product icon">
                                <div class="media-body media-body-cart">
                                    <h5 class="mt-2"><?=$product->GetData()["title"]?></h5>
                                    <form method="post" action="api/cart/removeItem.php">
                                        <input type="hidden" name="product_id" value="<?=$product->GetData()["id"]?>">
                                        <button class="delete-item-cart" type="submit"><i class="fas fa-times"></i></button>
                                    </form>
                                    <h5 class="media-body-cart-price text-dark"><?=$product->GetData()["price"]?> zł</h5>
                                </div>
                            </div>

                            <?php
                            $cart = true;
                        }
                        if(!isSet($cart)){
                            echo "<h5 class='text-secondary text-center mb-5 mt-5'>Koszyk jest pusty</h5>";
                        }
                        ?>
                        <p class="text-info"><i class="fas fa-info-circle"></i> Nie zwlekaj z zakupem, dodanie artykułów do koszyka nie oznacza ich rezerwacji.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="p-3 bg-white summary">
                        <h3 class="text-dark">Podsumowanie</h3>
                        Wartość koszyka: <b><?=$final_price?>zł</b>
                        <br />
                        przesyłka: <b>12.99zł</b>
                        <hr />
                        łączna kwota:  <b><?=$final_price+12.99?>zł</b>
                        <br /><br />

                        <form method="post" action="payments/pay.php">
                            <button class="btn btn-primary w-100" type="submit">Przejdź do kasy</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <?

    ?>
</body>

<?php require_once BASE_DIR."/template/footer.php"; ?>

</body >
</html >