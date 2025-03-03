<?php
declare (strict_types= 1);

namespace App\Controller;
use App\Dto\ProductDto;
use App\Entity\Roles;
use App\Service\ProductService;
use FOS\RestBundle\Controller\AbstractFOSRestController as Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;

#[Rest\Route(path:'/api/products')]
class ProductController extends Controller{
    public function __construct(private ProductService $productService){}
    #[Rest\Get]

    public function getAll( #[MapQueryParameter('min')]      float $minprice,#[MapQueryParameter('max')] float $maxprice) {
        
return $this->json( $this->productService->getAllProducts($minprice, $maxprice));
    }


#[Rest\Post]
#[IsGranted(Roles::ADM->value)]
public function addProdutos(#[MapRequestPayload(serializationContext: AbstractObjectNormalizer::SKIP_NULL_VALUES )] ProductDto $product)
{
    $this->productService->saveProduct(product: $product);
    return $this->json(["message" => 'product created'], Response::HTTP_CREATED);
}
#[Rest\Get(path: "/{name}", requirements: ['name' => '[a-aZ-Z]+'])]
public function getProduct(string $name)

{
    return $this->json($this->productService->getProductByName($name));

}
#[Rest\Put]
#[IsGranted(Roles::ADM->value)]
public function updateProduct(#[MapRequestPayload] ProductDto $product){
$this->productService->updateProduct(product: $product);
return $this->json(['message'=> 'product updated'], Response::HTTP_ACCEPTED);
}


}


