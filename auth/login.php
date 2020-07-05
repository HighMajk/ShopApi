<?php
require_once "../conf.php";
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
        <form method="post" action="/api/auth/login.php">
            <div class="form-group">
                <lable for="usernameOrEmail">Username or email:</lable>
                <input id="usernameOrEmail" class="form-control" type="text" name="usernameOrEmail" required>
            </div>
            <div class="form-group">
                <lable for="password">password:</lable>
                <input id="password" class="form-control" type="password" name="password" required>
            </div>
            <button class="btn btn-primary float-right" type="submit">Submit</button>
        </form>
    </div>
</div>
<?php require_once BASE_DIR."/template/footer.php"; ?>

</body >
</html >
