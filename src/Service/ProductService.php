<?php

namespace App\Service;

use App\Repository\ProductRepository;
use Generator;

class ProductService
{

    public function __construct(private ProductRepository $repository) {}
    public function getAllProducts(): Generator
    {
        yield $this->repository->findAll();
    }
}