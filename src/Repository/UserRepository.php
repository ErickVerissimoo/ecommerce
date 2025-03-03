<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
public function save(User $user): void
{
    if(self::findOneBy(['username' => $user->getUsername()]) !==NULL) {
throw new \Exception('entity already exists');
    }
    $em = self::getEntityManager();
    $em->persist($user);
    $em->flush();
    


}

public function delete(User $user)
{
    $this->getEntityManager()->remove($user);
    $this->getEntityManager()->flush();
}

}
