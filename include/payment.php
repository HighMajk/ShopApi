<?php

class Payment {
    function GenerateChk($DotpayId, $DotpayPin, $ParametersArray) {
        $ParametersArray['id'] = $DotpayId;

        $CHkInputString =   $DotpayPin.
            (isset($ParametersArray['api_version']) ? $ParametersArray['api_version'] : null).
            (isset($ParametersArray['lang']) ? $ParametersArray['lang'] : null).
            (isset($ParametersArray['id']) ? $ParametersArray['id'] : null).
            (isset($ParametersArray['amount']) ? $ParametersArray['amount'] : null).
            (isset($ParametersArray['currency']) ? $ParametersArray['currency'] : null).
            (isset($ParametersArray['description']) ? $ParametersArray['description'] : null).
            (isset($ParametersArray['control']) ? $ParametersArray['control'] : null).
            (isset($ParametersArray['channel']) ? $ParametersArray['channel'] : null).
            (isset($ParametersArray['url']) ? $ParametersArray['url'] : null).
            (isset($ParametersArray['type']) ? $ParametersArray['type'] : null).
            (isset($ParametersArray['buttontext']) ? $ParametersArray['buttontext'] : null).
            (isset($ParametersArray['urlc']) ? $ParametersArray['urlc'] : null).
            (isset($ParametersArray['firstname']) ? $ParametersArray['firstname'] : null).
            (isset($ParametersArray['lastname']) ? $ParametersArray['lastname'] : null).
            (isset($ParametersArray['email']) ? $ParametersArray['email'] : null).
            (isset($ParametersArray['street']) ? $ParametersArray['street'] : null).
            (isset($ParametersArray['street_n1']) ? $ParametersArray['street_n1'] : null).
            (isset($ParametersArray['city']) ? $ParametersArray['city'] : null).
            (isset($ParametersArray['postcode']) ? $ParametersArray['postcode'] : null).
            (isset($ParametersArray['phone']) ? $ParametersArray['phone'] : null).
            (isset($ParametersArray['country']) ? $ParametersArray['country'] : null).
            (isset($ParametersArray['ignore_last_payment_channel']) ? $ParametersArray['ignore_last_payment_channel'] : null);

        return hash('sha256',$CHkInputString);
    }

    ## GENERATE FORM TO DOTPAY
    function GenerateChkDotpayRedirection($DotpayId, $DotpayPin, $Environment, $RedirectionMethod, $ParametersArray) {
        $ChkValue = Payment::GenerateChk($DotpayId, $DotpayPin, $ParametersArray);

        if ($Environment == 'production') {
            $EnvironmentAddress = 'https://ssl.dotpay.pl/t2/';
        } elseif ($Environment == 'test') {
            $EnvironmentAddress = 'https://ssl.dotpay.pl/test_payment/';
        }

        if ($RedirectionMethod == 'POST') {
            $RedirectionCode = '<form action="'.$EnvironmentAddress.'" method="POST" id="dotpay_redirection_form" accept-charset="UTF-8">'.PHP_EOL;
            $RedirectionCode .= "\t".'<input name="id" value="'.$DotpayId.'" type="hidden"/>'.PHP_EOL;

            foreach ($ParametersArray as $key => $value)
            {
                $RedirectionCode .= "\t".'<input name="'.$key.'" value="'.$value.'" type="hidden"/>'.PHP_EOL;
            }
            $RedirectionCode .= "\t".'<input name="chk" value="'.$ChkValue.'" type="hidden"/>'.PHP_EOL;
            $RedirectionCode .= '</form>'.PHP_EOL.'<button id="dotpay_redirection_button" type="submit" form="dotpay_redirection_form" value="Submit">Confirm and Pay</button>'.PHP_EOL;

            return $RedirectionCode;

        } elseif ($RedirectionMethod == 'GET') {
            $RedirectionCode = $EnvironmentAddress.'?';

            foreach ($ParametersArray as $key => $value)
            {
                $RedirectionCode .= $key.'='.rawurlencode($value).'&';
            }

            $RedirectionCode .= 'id='.$DotpayId;
            $RedirectionCode .= '&chk='.$ChkValue;

            return '<a href="'.$RedirectionCode.'">Link to Pay</a>';
        }
    }

    function addPayment($DotpayId, $DotpayPin, $ParametersArray, $orderNo, $price) {
        $signature = Payment::GenerateChk($DotpayId, $DotpayPin, $ParametersArray);
        $db = MysqliDb::getInstance();
        $db->insert("orders", [
            "order_no" => $orderNo,
            "signature" => $signature,
            "user_id" => Me::GetUser()->GetData()["id"],
            "price" => $price,
            "payment_status_id" => "1",
            "order_status_id" => "1",
            "create_date" => date("Y.m.d H:i:s")
        ]);
    }

    function addOrderProducts($paymentId) {
        foreach(Cart::GetProducts() as $product) {
             $product->GetData();
        }

    }

    function GetOrder($orderNo){
        $db = MysqliDb::getInstance();
        $db->where("order_no", $orderNo);
        return $db->getOne("orders");
    }
}