<?php
    require_once "../../conf.php";

    if($_SERVER['REMOTE_ADDR'] === DOTPAYIP){
        $orderNo = $_POST['control'];
        $operation_amount= $_POST['operation_amount'];
        $signature = $_POST['signature'];
        $status = $_POST['operation_status'];
        $statusId = 5;

        $order = Payment::GetOrder($orderNo);

        if($order['order_no'] != $orderNo){
            $db = MysqliDb::getInstance();
            $db->where("order_no", $orderNo);
            $db->update("orders", [
                "payment_status_id" => $statusId+2
            ]);
            die("not OK");
        }
        if($order['price'] != $operation_amount){
            $db = MysqliDb::getInstance();
            $db->where("order_no", $orderNo);
            $db->update("orders", [
                "payment_status_id" => $statusId+3
            ]);
            die("not OK");
        }
        if(hash_equals($order['signature'], $signature)){
            $db = MysqliDb::getInstance();
            $db->where("order_no", $orderNo);
            $db->update("orders", [
                "payment_status_id" => $statusId+4
            ]);
            die("not OK");
        }

        if($status == "new"){
            $statusId = 2;
        }
        else if($status == "processing") {
            $statusId = 2;
        }
        else if($status == "completed") {
            $statusId = 3;
        }
        else if($status == "rejected") {
            $statusId = 4;
        }
        else{
            $statusId = 5;
        }
        $db = MysqliDb::getInstance();
        $db->where("order_no", $orderNo);
        $db->update("orders", [
            "payment_status_id" => $statusId
        ]);

        if($status == "completed"){
            $db = MysqliDb::getInstance();
            $db->where("order_no", $orderNo);
            $db->update("orders", [
                "payment_date" => date("Y.m.d H:i:s")
            ]);
        }

        echo "OK";
    }
    else{
        die("Nieautoryzowany dostęp");
    }





