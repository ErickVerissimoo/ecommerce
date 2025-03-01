<?php

namespace App\Service;
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
        
        Stripe::setApiKey(getenv('STRIPE_KEY'));
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
