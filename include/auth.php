<?php
class Auth{

    public static function Register(
        string $username,
        string $email,
        string $password,
        &$err_message) : bool{

        if(strlen($username) > USER_USERNAME_MAX_LEN){
            $err_message = "Max username length is 32";
            return false;
        }

        $db = MysqliDb::getInstance();
        $db->where("username", $username);
        $db->orWhere("email", $email);
        $row = $db->getOne("users");

        if($row !== null) {
            if(strcasecmp($username, $row["username"]) === 0){
                $err_message = "This username is already taken";
                return false;
            }
            else{
                $err_message = "This email is already taken";
                return false;
            }

        }

        $password_hash = password_hash($password, PASSWORD_HASH_ALGO);

        $db->insert("users", [
            "username" => $username,
            "email" => $email,
            "password_hash" => $password_hash,
            "is_activated" => 1, //TODO: add email verefi
            "is_admin" => 0,
        ]);

        return true;
    }

    public static function Login(
        string $usernameOrEmail,
        string $password,
        &$err_message) : bool {

        $db = MysqliDb::getInstance();
        $db->where("username", $usernameOrEmail);
        $db->orWhere("email", $usernameOrEmail);
        $row = $db->getOne("users");

        if($row === null) {
            $err_message = "Invalid login credentials";
            return false;
        }

        $password_hash = $row["password_hash"];

        if(!password_verify($password, $password_hash)) {
            $err_message = "Invalid password credentials";
            return false;
        }

        if($row["is_activated"] == 0) {
            $err_message = "Account is not activated";
            return false;
        }

        if(!Session::CreateSession($row["id"], SESSION_EXPIRE_DAYS, $session_token)){
            $err_message = "Failed to create user session";
            return false;
        }

        $expire_time = time() + SESSION_EXPIRE_DAYS * 24 * 60 * 60;
        setcookie(SESSION_COOKIE_NAME, $session_token, $expire_time, "/");

        return true;
    }

    public static function LoginCookie(&$user_id) : bool{
        if(!isset($_COOKIE[SESSION_COOKIE_NAME])) {
            return false;
        }

        $session_token = $_COOKIE[SESSION_COOKIE_NAME];

        if(!Session::ValidateSession($session_token, $user_id)){
            return false;
        }

        return true;
    }

}

