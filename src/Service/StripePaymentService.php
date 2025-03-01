<?php

namespace App\Service;
use App\Dto\PaymentDto;
use App\Entity\Status;
use App\Repository\OrderRepository;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Stripe\Refund;
use Stripe\Stripe;
use Stripe\Token;

class StripePaymentService
{
  

    public function __construct(private OrderRepository $orderRepository)
    {
        
        Stripe::setApiKey(getenv('STRIPE_KEY'));
    }
public function pay(PaymentDto $paymentDto)
{

    $order = $this->orderRepository->find($paymentDto->orderId);
    $order->setOrderStatus(Status::FINALIZADO);
    $this->orderRepository->getEntityManager()->persist($order);
    
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
