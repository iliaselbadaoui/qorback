<?php

header('Access-Control-Allow-Origin: *');
//use YouCan\Pay\YouCanPay;
require '../vendor/autoload.php';

error_reporting(E_ERROR);
$youCanPay = new \YouCan\Pay\YouCanPay(new \YouCan\Pay\API\HTTPAdapter\HTTPAdapterPicker());

$transaction = $youCanPay->transaction->get("transaction-id");

if (is_null($transaction)) {
    echo "TRANSACTION NULL";
}
