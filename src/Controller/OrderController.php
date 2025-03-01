<?php

namespace App\Controller;

use App\Dto\OrderItemDto;
use App\Dto\PaymentDto;
use App\Entity\User;
use App\Service\OrderService;
use FOS\RestBundle\Controller\AbstractFOSRestController as Controller;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
#[Route(path:'/api/order')]
class OrderController extends Controller
{
    public function __construct(private OrderService $order){}
    #[Post]
public function create( UserInterface $user,#[MapRequestPayload] OrderItemDto $dto){
    $email = $user->getUserIdentifier();
    $order = $this->order->createOrder($email, $dto);

    return $this->json(['total price'=> $order->getOrderItems()->get(0)->getTotalPrice() ]);
}
#[Put]
public function methodName(UserInterface $user, #[MapRequestPayload] PaymentDto $dto)
{
    
}




}