<?php

namespace App\Dto;

use JsonSerializable;

class ProductDto 
{   
    public function __construct(public string $name, public float $price, public string $description)
    {}



}