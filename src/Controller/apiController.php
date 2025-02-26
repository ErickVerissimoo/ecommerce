<?php

namespace App\Controller;

use App\Dto\DtoResolver;
use App\Dto\ProductDto;
use App\Entity\Roles;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as controlador;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\ValueResolver;
use Symfony\Component\Routing\Annotation\Route as rota;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class apiController extends controlador
{
    public function __construct(private ProductService $productService){}
    #[rota(path:"/api/products", name:"obter todos os produtos", methods: ["GET"])]
    public function getAll(): JsonResponse{
        
        return new JsonResponse($this ->productService->getAllProducts());
}
#[rota(path:"/api/products", name: 'adicionar produtos', methods: ['POST'])]
#[IsGranted(Roles::ADM->value)]
public function addProdutos(#[ValueResolver(DtoResolver::class)] ProductDto $product): JsonResponse
{
    $this->productService->saveProduct($product);
    return new JsonResponse(["message" => 'user created'], Response::HTTP_CREATED);
}
#[rota(path: "/api/products/{name}", name: 'obter produtos', methods:['GET'])]
public function getProduct(string $name): JsonResponse{
    return new JsonResponse($this->productService->getProductByName($name));

}



}


