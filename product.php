<?php
require_once "conf.php";
?>
<!doctype html >
<html lang = "en" >
<head >
    <title>Home</title >
    <?php require_once BASE_DIR."/template/header.php"?>
</head >
<body >
    <?php
    require_once BASE_DIR."/template/navbar.php";
    $id = GET("id", true);

    try {
        $product = new Product((int) $id);
    }
    catch (Exception $ex) {
        http_response_code(404);
        exit("Error: Product not found");
    }
    ?>
    <div class="container">
        <div class="content">
            <div class="row">
                <div class="col-md-6 product">
                    <div class="card">
                        <div class="card-body">
                            <img class="product-page-img" src="<?=$product->GetData()["icon_url"]?>" alt="Product icon">
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <h2 class="product-title"><?=$product->GetData()["title"]?></h2>
                   <h5 class="d-inline"><?=$product->GetData()["price"]?> zł</h5><span class="text-secondary d-inline"> w tym VAT</span>
                    <br /><br />
                    <h4>Dostawa:</h4>
                    <ul>
                        <li>Paczkomaty inpost: 13.99zł</li>
                        <li>Kurier: 17.99zł</li>
                    </ul>
                    <br />
                    <?php
                        if(Me::IsLoggedIn()){
                            ?>
                            <form method="post" action="/api/cart/addItem.php">
                                <input type="hidden" name="product_id" value="<?=$product->GetData()["id"]?>">
                                <button class="btn btn-primary w-100" type="submit">Dodaj do koszyka</button>
                            </form>

                            <?php
                        }
                        else{
                            ?>
                            <a href="/auth/login.php" class="btn btn-secondary w-100">Zaloguj się aby dodać do koszyka</a>
                            <?php
                        }
                    ?>

                    <br /><br />
                    <h4>Opis</h4>
                    <div class="card">
                        <div class="card-body">
                            <?=$product->GetData()["description"]?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once BASE_DIR."/template/footer.php"; ?>

</body >
</html >