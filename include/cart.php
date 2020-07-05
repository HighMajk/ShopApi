<?php
class Cart {

    public static function GetProducts() : Generator {
        $db = MysqliDb::getInstance();
        $db->where("user_id", Me::GetUser()->GetData()["id"]);
        $db->orderBy("id", "DESC");
        foreach($db->get("cart") as $row) {
            yield new Product($row["product_id"]);
        }
    }

    public static function AddToCart(int $product_id) : bool {
        try {
            $x = new Product($product_id);
        }
        catch(Exception $ex) {
            return false;
        }

        $user_id = Me::GetUser()->GetData()["id"];
        $db = MysqliDb::getInstance();
        $db->insert("cart", [
            "user_id" => $user_id,
            "product_id" => $product_id,
        ]);
        return true;
    }

    public static function RemoveFromCart(int $product_id) : bool {
        $db = MysqliDb::getInstance();
        $db->where("user_id", Me::GetUser()->GetData()["id"]);
        $db->where("product_id", $product_id);
        $db->delete("cart", 1);
        return true;
    }

    public static function ClearCart() : void {
        $db = MysqliDb::getInstance();
        $db->where("user_id", Me::GetUser()->GetData()["id"]);
        $db->delete("cart");
    }

}