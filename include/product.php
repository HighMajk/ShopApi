<?php
class Product {

    private $_prod_id;
    private $_prod_data;

    public function __construct(int $product_id) {
        $this->_prod_id = $product_id;
        $this->UpdateData();
    }

    public function GetData() : array {
        return $this->_prod_data;
    }

    private function UpdateData() : void {
        $db = MysqliDb::getInstance();
        $db->where("id", $this->_prod_id);
        $this->_prod_data = $db->getOne("products");

        if($this->_prod_data === null) {
            throw new Exception("(E)Product with ID = {$this->_prod_id} not found");
        }
    }

    public function DecQuantity() : bool {
        $db = MysqliDb::getInstance();
        $db->where("id", $this->_prod_id);
        return $db->update("products", [
            "quantity" => $db->dec(),
        ]);
    }

}