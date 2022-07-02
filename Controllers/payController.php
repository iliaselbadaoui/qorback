<?php

header('Access-Control-Allow-Origin: *');
//use YouCan\Pay\YouCanPay;
require '../vendor/autoload.php';

error_reporting(E_ERROR);
$youCanPay = YouCanPay::instance()->useKeys('pri_key', 'pub_key');

$transaction = $youCanPay->transaction->get("transaction-id");

if (is_null($transaction)) {
    echo "TRANSACTION NULL";
}
