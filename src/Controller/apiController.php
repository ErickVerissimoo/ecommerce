<?php

namespace App\Controller;

use App\Dto\DtoResolver;
use App\Dto\ProductDto;
use App\Entity\Product;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\ValueResolver;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\VarDumper\Cloner\AbstractCloner;

class apiController extends AbstractController
{
    public function __construct()

    {
    }
    #[Route(path:"/ugue", name:"teste", methods: ["POST"])]
    public function index(#[ValueResolver(DtoResolver::class)] ProductDto $product): Response{
        
   
return new Response($product->getPrice());
    }

   
}