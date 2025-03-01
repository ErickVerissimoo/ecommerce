<?php

namespace App\Controller;

use App\Dto\OrderItemDto;
use App\Dto\PaymentDto;
use App\Service\OrderService;
use FOS\RestBundle\Controller\AbstractFOSRestController as Controller;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Security\Core\User\UserInterface;

#[Route(path:'/api/order')]
class OrderController extends Controller
{
    public function __construct(private OrderService $order){}
    #[Post]
public function create( UserInterface $user,#[MapRequestPayload] OrderItemDto $dto){
    $email = $user->getUserIdentifier();
    $order = $this->order->createOrder($email, $dto);

    return $this->json(['total price'=> $order->getOrderItems()->last()->getTotalPrice() ]);
}
#[Put]
public function pay(#[MapRequestPayload] PaymentDto $dto)
{
  
    $this->order->payOrder($dto);
    return $this->json(['message' => 'order payed']);
}




}