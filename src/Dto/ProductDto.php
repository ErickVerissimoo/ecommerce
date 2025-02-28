<?php

namespace App\Dto;

readonly class ProductDto 
{   
    public function __construct(public ?int $id, public string $name, public float $price, public string $description)
    {}



}