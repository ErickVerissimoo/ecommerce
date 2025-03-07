<?php

namespace App\Entity;

use App\Repository\OrderItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PostLoad;
use Symfony\Component\Serializer\Attribute\Ignore;

#[ORM\Entity(repositoryClass: OrderItemRepository::class)]
class OrderItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orderItems')]
    #[ORM\JoinColumn(nullable: false)]
    #[Ignore]
    private ?Order $itemOrder = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\Column]
    private ?int $quantidade = null;
    private ?float $totalPrice = 0;

#[PostLoad]
    public function getTotalPrice(){
        $totalPrice = $this->quantidade * $this->getProduct()->getPrice();
return $totalPrice;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItemOrder(): ?Order
    {
        return $this->itemOrder;
    }

    public function setItemOrder(?Order $itemOrder): static
    {
        $this->itemOrder = $itemOrder;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantidade(): ?int
    {
        return $this->quantidade;
    }

    public function setQuantidade(int $quantidade): static
    {
        $this->quantidade = $quantidade;

        return $this;
    }




}
