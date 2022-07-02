<?php

namespace YouCan\Pay;
use YouCan\Pay\YouCanPay as YouCanPay;
header('Access-Control-Allow-Origin: *');

error_reporting(E_ERROR);
$youCanPay = YouCanPay::instance()->useKeys('pri_key', 'pub_key');

$transaction = $youCanPay->transaction->get("transaction-id");

if (is_null($transaction)) {
    echo "TRANSACTION NULL";
}
