<?php

use YouCan\Pay\YouCanPay;

$youCanPay = YouCanPay::instance()->useKeys('pri_key', 'pub_key');

// generate a token for a new payment
$token = $youCanPay->token->create("order-id", "2000", "USD", "123.123.123.123");

echo $token->getId();
