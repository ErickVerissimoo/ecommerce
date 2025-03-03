<?php

namespace App\Service;

use App\Dto\OrderItemDto;
use App\Dto\PaymentDto;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use App\Entity\Status;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Exception;

class OrderService
{
    public function __construct(private readonly OrderRepository $repository, private readonly UserRepository $userRepository,
    private readonly StripePaymentService $payment){
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


public function payOrder(PaymentDto $paymentDto)
{
    $this->payment->pay($paymentDto);

    $order = $this->repository->find($paymentDto->orderId);
    $order-> setOrderStatus(Status::FINALIZADO);
}
public function cancelOrder(PaymentDto $dto){
    $order = $this->repository->find($dto->orderId);
    $order->setStatus(Status::CANCELADO);
    $this->repository->getEntityManager()->persist($order);
    $this->userRepository->getEntityManager()->flush();
    return $order;

}

public function getOrderById(int $id){
return $this->repository->find($id)?? throw new Exception('entity not founded');
}

    }

