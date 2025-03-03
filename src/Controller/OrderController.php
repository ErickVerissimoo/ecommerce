<?php

namespace App\Controller;

use App\Dto\OrderItemDto;
use App\Dto\PaymentDto;
use App\Entity\Order;
use App\Service\OrderService;
use FOS\RestBundle\Controller\AbstractFOSRestController as Controller;
use FOS\RestBundle\Controller\Annotations as Routing;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Security\Core\User\UserInterface;



#[Routing\Route(path:'/api/order')]
class OrderController extends Controller
{
    public function __construct(private OrderService $order){}
    #[Routing\Post]
public function create( UserInterface $user,#[MapRequestPayload] OrderItemDto $dto){
    $email = $user->getUserIdentifier();

    $order = $this->order->createOrder($email, $dto);

    return $this->json(['total price'=> $order->getOrderItems()->last()->getTotalPrice() ]);
}
#[Routing\Put]
public function pay(#[MapRequestPayload] PaymentDto $dto)
{
  
    $this->order->payOrder($dto);
    return $this->json(['message' => 'order payed']);
}
#[Routing\Delete]
public function cancelProduct(#[MapRequestPayload] PaymentDto $dto)
{
    $this->order->cancelOrder($dto);
    return $this->json(['message'=> 'deleted']);
}
#[Routing\Get(path:'/{id}')]
public function getOrder(#[MapEntity] Order $order){

return $this->json(data:$order, context:['groups' => ['order:read']]);

}

}