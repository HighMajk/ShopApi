<?php
class Store {
    public static function GetProducts() : Generator {
        $db = MysqliDb::getInstance();
        $db->orderBy("id", "DESC");
        foreach($db->get("products") as $row) {
            yield new Product($row["id"]);
        }
    }
}