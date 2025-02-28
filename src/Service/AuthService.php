<?php

namespace App\Service;

use App\Dto\UserRequestDto;
use App\Entity\User;
use App\Repository\UserRepository;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
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

     
            if ($this->repository->findOneBy(['username' => $dto->username]) !== null) {
                throw new Exception('Entity already exists', Response::HTTP_CONFLICT);
            }
      
    
   $user=        new User($dto->username, $dto->password);
    $hashed = $this->hasher->hashPassword($user, $dto->password);
    $user->setPassword($hashed);
    $this->repository->getEntityManager()->persist($user);
    $this->repository->getEntityManager()->flush();

    }

}