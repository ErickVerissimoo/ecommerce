<?php

namespace App\Controller;

use App\Dto\DtoResolver;
use App\Dto\ProductDto;
use App\Entity\Product;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as controlador;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\ValueResolver;
use Symfony\Component\Routing\Annotation\Route as rota;

class apiController extends controlador
{
    public function __construct(private ProductService $productService)

    {
    }
    #[rota(path:"/api/products", name:"obter todos os produtos", methods: ["GET"])]
    public function getAll(): JsonResponse{
        
        return new JsonResponse($this ->productService->getAllProducts());

   
}
}