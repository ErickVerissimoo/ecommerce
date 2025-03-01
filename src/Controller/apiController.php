<?php

namespace App\Controller;

use App\Dto\ProductDto;
use App\Entity\Roles;
use App\Service\ProductService;
use FOS\RestBundle\Controller\AbstractFOSRestController as Controller;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
#[Route(path:'/api/products')]
class apiController extends Controller{
    public function __construct(private ProductService $productService){}
    #[Get]
    public function getAll() {
        
return $this->json($this->productService->getAllProducts());
    }

#[Post]
#[IsGranted(Roles::ADM->value)]
public function addProdutos(#[MapRequestPayload(serializationContext: AbstractObjectNormalizer::SKIP_NULL_VALUES )] ProductDto $product)
{
    $this->productService->saveProduct(product: $product);
    return $this->json(["message" => 'product created'], Response::HTTP_CREATED);
}
#[Get(path: "/{name}")]
public function getProduct(string $name)

{
    return $this->json($this->productService->getProductByName($name));

}
#[Put]
#[IsGranted(Roles::ADM->value)]
public function updateProduct(#[MapRequestPayload] ProductDto $product){
$this->productService->updateProduct(product: $product);
return $this->json(['message'=> 'product updated'], Response::HTTP_ACCEPTED);
}


}


