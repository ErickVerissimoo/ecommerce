<?php

namespace App\Dto;

readonly class OrderItemDto
{
    public function __construct(public int $quantidade, public ProductDto $product){

    }
}