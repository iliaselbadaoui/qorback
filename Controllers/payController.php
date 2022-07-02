<?php

header('Access-Control-Allow-Origin: *');
require '../vendor/autoload.php';

error_reporting(E_ERROR);
$youCanPay = \YouCan\Pay\YouCanPay::instance()->useKeys('pri_sandbox_9858abcb-be2c-4e3c-bbc6-8c7af', 'pub_sandbox_4a6c718a-4a4e-4d3b-afbd-9d30e');

$token = $youCanPay->token->create("order-id", "2000", "USD", "123.123.123.123");

echo $token->getId();
