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
<?php require_once BASE_DIR."/template/navbar.php";?>
<div class="container">
    <div class="content">
        <div class="row">
            <?php
            foreach(Store::GetProducts() as $product) {
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4 product">
                    <a href="/product.php?id=<?=$product->GetData()['id']?>">
                        <div class="card">
                            <div class="card-body">
                                <img class="product-img" src="<?=$product->GetData()["icon_url"]?>" alt="Product icon">
                            </div>
                            <div class="card-footer">
                                <h5 class="card-title"><?=$product->GetData()["title"]?></h5>
                                <p class="card-text"><?=$product->GetData()["price"]?>PLN</p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<?php require_once BASE_DIR."/template/footer.php"; ?>

</body >
</html >