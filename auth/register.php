<?php
require_once "../conf.php";
?>
<!doctype html >
<html lang = "en" >
<head >
    <title>Register</title >
    <?php require_once BASE_DIR."../template/header.php"?>
</head >
<body >
<?php require_once BASE_DIR."/template/navbar.php";?>
<div class="container">
    <div class="content">
        <form method="post" action="/api/auth/register.php">
            <div class="form-group">
                <lable for="username">Username:</lable>
                <input id="username" class="form-control" type="text" maxlength="<?=USER_USERNAME_MAX_LEN?>" name="username" required>
            </div>
            <div class="form-group">
                <lable for="email">email:</lable>
                <input id="email" class="form-control" type="text" name="email" required>
            </div>
            <div class="form-group">
                <lable for="password">password:</lable>
                <input id="password" class="form-control" type="password" name="password" required>
            </div>
            <div class="form-group">
                <lable for="confirm_password">Confirm password:</lable>
                <input id="confirm_password" class="form-control" type="password" name="confirm_password" required>
            </div>
            <div class="custom-control custom-checkbox">
                <input id="accept_tos" class="custom-control-input" type="checkbox" name="accept_tos" value="true" required>
                <label for="accept_tos" class="custom-control-label">I accept Terms of Service</label>
            </div>
            <button class="btn btn-primary float-right" type="submit">Submit</button>
        </form>
    </div>
</div>
<?php require_once BASE_DIR."../template/footer.php"; ?>
</body >
</html >
