<?php

require 'vendor/autoload.php';

use App\Dto\PaymentDto;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Stripe\Refund;
use Stripe\Stripe;
use Stripe\Token;

class StripePaymentService
{
  

    public function __construct()
    {
        
        Stripe::setApiKey('sk_test_51Qxdr0JyCJeGjWWyKXsBIo19uHdbjRC5hrqfwHKEZDpox4IMnn5DaiM9YxS1OqRSXD7rTv8d2RL7JSDhv4mUbL3y00NTfkq8lE');
    }
public function pay(PaymentDto $paymentDto)
{
    $token = $this->generateTokenPayment($paymentDto->getArrayPayment());
    $charge = Charge::create([
        'amount'=> $paymentDto->amount,
        'currency'=> $paymentDto->currency,
        'source'=> $token->id,
    ]);


}

private function generateTokenPayment(array $card){
return Token::create(['card' => ['number' => $card['number'],
'exp_mounth' => $card['exp_mounth'],
'exp_year' => $card['exp_year'],
'cvc' => $card['cvc']]]);
}

}