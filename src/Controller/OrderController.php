<?php

namespace App\Controller;

use App\Dto\OrderItemDto;
use App\Entity\User;
use App\Service\OrderService;
use FOS\RestBundle\Controller\AbstractFOSRestController as Controller;
use FOS\RestBundle\Controller\Annotations\Post;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
class OrderController extends Controller
{
    public function __construct(private OrderService $order){}
    #[Post(path:'/api/order')]
public function create( UserInterface $user,#[MapRequestPayload] OrderItemDto $dto){
    $email = $user->getUserIdentifier();
    $order = $this->order->createOrder($email, $dto);

    return $this->json(['total price'=> $order->getOrderItems()->get(0)->getTotalPrice() ]);
}




}