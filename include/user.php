<?php
class User {

    private $_user_id;
    private $_user_data;

    public function __construct(int $user_id) {
        $this->_user_id = $user_id;
        $this->UpdateData();
    }

    public function GetData() : array{
        return $this->_user_data;
    }

    private function UpdateData() : void{
        $db = MysqliDb::getInstance();
        $db->where("id", $this->_user_id);
        $this->_user_data = $db->getOne("users");

        if($this->_user_id === null){
            throw new Exception("User with ID = {$this->_user_id} not found");
        }
    }

    public function ChangeEmail(string $email, &$err_message) : bool {
        $db = MysqliDb::getInstance();
        $db->where("email", $email);
        $row = $db->getOne("users");

        if($row !== null) {
            $err_message = "ERROR: This email is already taken";
            return false;
        }

        $db->where("id", $this->_user_data["id"]);
        $db->update("users", [
            "email" => $email,
        ]);
        $this->UpdateData();
        return true;
    }

    public function ChangePassword(string $current_password, string $password, &$err_message) : bool {
       if(!password_verify($current_password, $this->_user_data["password_hash"])) {
           $err_message = "invalid current password";
           return false;
       }

        $password_hash = password_hash($password, PASSWORD_HASH_ALGO);

        $db = MysqliDb::getInstance();
        $db->where("id", $this->_user_data["id"]);
        $db->update("users", [
            "password_hash" => $password_hash,
        ]);

        $this->UpdateData();
        return true;
    }
}