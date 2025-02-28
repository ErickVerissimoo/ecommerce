<?php

namespace App\Controller;

use App\Dto\DtoResolver;
use App\Dto\ProductDto;
use App\Entity\Roles;
use App\Service\ProductService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\ValueResolver;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class apiController extends AbstractFOSRestController{
    public function __construct(private ProductService $productService){}
    #[Get(path:"/api/products")]
    public function getAll() {
        
return $this->json($this->productService->getAllProducts());
    }
#[Post(path:"/api/products")]
#[IsGranted(Roles::ADM->value)]
public function addProdutos(#[ValueResolver(DtoResolver::class)] ProductDto $product)
{
    $this->productService->saveProduct(product: $product);
    return $this->json(["message" => 'product created'], Response::HTTP_CREATED);
}
#[Get(path: "/api/products/{name}")]
public function getProduct(string $name)

{
    return $this->json($this->productService->getProductByName($name));

}



}


