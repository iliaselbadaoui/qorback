<?php
namespace YouCan\Pay;
use YouCan\Pay\YouCanPay;

class ycpServices
{

    public function __construct()
    {
    }

    public function createToken()
    {
        // Enable sandbox mode, otherwise delete this line.
        YouCanPay::setIsSandboxMode(true);

        // Create a YouCan Pay instance, to retrieve your private and public keys login to your YouCan Pay account
        // and go to Settings and open API Keys.
        $youCanPay = YouCanPay::instance()->useKeys('pri_sandbox_9858abcb-be2c-4e3c-bbc6-8c7af', 'pub_sandbox_4a6c718a-4a4e-4d3b-afbd-9d30e');

        // generate a token for a new payment
        $token = $youCanPay->token->create("order-id", "2000", "USD", "123.123.123.123");

        return $token->getId();
    }
}