<?php

namespace App\Dto;

use JsonSerializable;

class ProductDto implements JsonSerializable
{


    
    public function __construct(private string $name, private float $price)
    {
        
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
    /**
     * @inheritDoc
     */
    public function jsonSerialize():array {
        return get_object_vars($this);
    }
}