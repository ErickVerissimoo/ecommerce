<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }
public function save(Product $product): ?Product{
    $this->_em->persist($product);
    $this->_em->flush();

}


public function between(?float $min, ?float $max){
$em = $this->getEntityManager();
if($min && $max){
    $query = $em->createQuery(
        'SELECT e FROM App\Entity\Product e
               WHERE e.price BETWEEN :min AND :max'
       
       );
       $query->setParameters([
           'min'=> $min,
           'max'=> $max
       ]);
       return $query->getArrayResult();
}else if($min && !$max){
$query = $em->createQuery('SELECT e from App\Entity\Product e where e.price>:min');
$query->setParameter('min', $min);
return $query->getArrayResult();
}
$query = $em->createQuery('SELECT e from App\Entity\Product e where e.price<=:max');
    $query->setParameter('max', $max);

    return $query->getArrayResult();

}

}
