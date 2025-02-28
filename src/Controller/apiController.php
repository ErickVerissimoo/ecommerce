<?php

namespace App\Controller;

use App\Dto\ProductDto;
use App\Entity\Roles;
use App\Service\ProductService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;

class apiController extends AbstractFOSRestController{
    public function __construct(private ProductService $productService){}
    #[Get(path:"/api/products")]
    public function getAll() {
        
return $this->json($this->productService->getAllProducts());
    }

#[Post(path:"/api/products")]
#[IsGranted(Roles::ADM->value)]
public function addProdutos(#[MapRequestPayload(serializationContext: AbstractObjectNormalizer::SKIP_NULL_VALUES )] ProductDto $product)
{
    $this->productService->saveProduct(product: $product);
    return $this->json(["message" => 'product created'], Response::HTTP_CREATED);
}
#[Get(path: "/api/products/{name}")]
public function getProduct(string $name)

{
    return $this->json($this->productService->getProductByName($name));

}
#[Put(path: '/api/products')]
#[IsGranted(Roles::ADM->value)]
public function updateProduct(#[MapRequestPayload] ProductDto $product){
$this->productService->updateProduct(product: $product);
return $this->json(['message'=> 'product updated'], Response::HTTP_ACCEPTED);
}


}


