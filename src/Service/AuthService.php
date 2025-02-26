<?php

namespace App\Service;

use App\Dto\UserRequestDto;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\OrderBy;
use Exception;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\SerializerInterface;

class AuthService
{
    public function __construct
    (
    private UserRepository $repository,
    private SerializerInterface $serializer,
    private  UserPasswordHasherInterface $hasher){}

    public function register(UserRequestDto $dto)
    {

        if($this->repository->findOneBy(['email'=> $dto->email])) {
throw new Exception('entity exists');
        }
$user=        new User($dto->email, $dto->password);
$hashed = $this->hasher->hashPassword($user, $dto->password);
$user->setPassword($hashed);
$this->repository->getEntityManager()->persist($user);
$this->repository->getEntityManager()->flush();
    }

}