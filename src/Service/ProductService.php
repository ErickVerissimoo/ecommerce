<?php

namespace App\Service;

use App\Dto\ProductDto;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Generator;

class ProductService
{

    public function __construct(private ProductRepository $repository) {}
    public function getAllProducts(?float $minprice=null, ?float $maxprice =null): array
    {
return $this->repository->between($minprice, $maxprice);
        
        
    }
 public function getProductById(int $id): Product{
    $product = $this->repository->find($id);
    if (!$product) {
        throw new \Exception("product not found
        ", 404);
    }
    return $product;
 }
    public function getProductByName(string $name): Product {
        $product = $this->repository->findOneBy(["name"=> $name]);
        if (!$product) {
            throw new \Exception("product not found
            ",404 );
        }
        return $product;


    }

public function saveProduct(ProductDto $product): void{
    $produto = new Product($product);
    $this->repository->save($produto);
    
}

public function updateProduct(ProductDto $product){
$produto = $this->repository->find($product->id);
$produto->setName($product->name);
$produto->setDescription($product->description);
$produto->setPrice($product->price);
$this->repository->getEntityManager()->persist($produto);
$this->repository->getEntityManager()->flush();

}
public function getAllBetween(int $min, int $max)
{
    return $this->repository->between($min, $max);
}
}