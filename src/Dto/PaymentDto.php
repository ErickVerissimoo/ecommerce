<?php

namespace App\Dto;

readonly class PaymentDto
{
    public function __construct(
     public int $amount, public string $currency,   public string $number, public int $exp_month, public int $exp_year, public int $cvc,
     public int $orderId) {
        
    }


    public function getArrayPayment()
    {
        $array= get_object_vars($this);
        unset($array["currency"]);
        unset($array["amount"]);
        return $array;
    }
}