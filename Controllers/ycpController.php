<?php

require_once 'vendor/autoload.php';

$youCanPay = YouCanPay::instance()->useKeys('pri_572164be-be2c-42d7-928a-66fc6680', 'pub_f9a7b5c1-2fc9-43b3-be3e-ee96b140');

// generate a token for a new payment
$token = $youCanPay->token->create("order-id", "2000", "USD", "123.123.123.123");

echo $token->getId();
