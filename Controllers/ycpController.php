<?php

use YouCan\Pay\YouCanPay;

$youCanPay = YouCanPay::instance()->useKeys('pri_key', 'pub_key');

$transaction = $youCanPay->transaction->get("transaction-id");

if (is_null($transaction)) {
    echo "not_valid";
}

// fetch your order
$order = Order::first();

// the amount is in smallest currency unit
$amount = $transaction->getBaseAmount() ?? $transaction->getAmount();

if (bccomp($amount, $order->getAmount()) !== 0) {
// the YouCan Pay transaction amount is different than the order amount
}
