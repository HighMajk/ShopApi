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
    <?php require_once BASE_DIR."/template/header.php"?>
</head >
<body >
<?php require_once BASE_DIR."/template/navbar.php"; ?>
<div class="container">
    <div class="content">
        <div class="card mb-3">
            <div class="card-body">
                <div class="form-group">
                    <label for="username">Nazwa Użytkownika:</label>
                    <input type="text" id="username" class="form-control" value="<?=Me::GetUser()->GetData()["username"]?>" aria-describedby="helpId" readonly>
                </div>
            </div>
        </div>
        <form class="card mb-3" method="post" action="/api/user/changeEmail.php">
            <div class="card-body">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?=Me::GetUser()->GetData()["email"]?>" aria-describedby="helpId" required>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Zapisz</button>
            </div>
        </form>
        <form class="card" method="post" action="/api/user/changePassword.php">
            <div class="card-body">
                <div class="form-group">
                    <label for="current_password">Akutalne hasło:</label>
                    <input type="text" name="current_password" id="current_password" class="form-control" aria-describedby="helpId" required>
                    <label for="password">Nowe hasło:</label>
                    <input type="text" name="password" id="password" class="form-control" aria-describedby="helpId" required>
                    <label for="confirm_password">Potwirdź nowe hasło:</label>
                    <input type="text" name="confirm_password" id="confirm_password" class="form-control" aria-describedby="helpId" required>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Zapisz</button>
            </div>
        </form>
    </div>

</div>
<?php require_once BASE_DIR."/template/footer.php"; ?>

</body >
</html >