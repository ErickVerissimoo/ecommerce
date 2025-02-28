<?php

namespace App\Service;

use App\Dto\OrderItemDto;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use App\Entity\Status;
use App\Entity\User;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use DateTime;
use DateTimeImmutable;

class OrderService
{
    public function __construct(private readonly OrderRepository $repository, private readonly UserRepository $userRepository){
    }
    public function createOrder(string $email, OrderItemDto $item){
        $order = new Order;
        $orderI = new OrderItem;
        $orderI->setQuantidade($item->quantidade);
        $orderI->setProduct(new Product($item->product));
        $orderI->setItemOrder($order);
        $order->addOrderItem($orderI);
        $order->setCreatedAt(new DateTimeImmutable('now'));
        $order->setOrderStatus(Status::PENDENTE);
        
        $user = $this->userRepository->findOneBy(['username'=> $email]);
        $user->addOrder($order);

        $this->userRepository->getEntityManager()->persist($user);
        $this->userRepository->getEntityManager()->flush();
        return $order;
    }

    }

