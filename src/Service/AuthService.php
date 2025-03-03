<?php

namespace App\Service;

use App\Dto\UserRequestDto;
use App\Entity\User;
use App\Repository\UserRepository;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AuthService
{
    public function __construct
    (
    private UserRepository $repository,
    private  UserPasswordHasherInterface $hasher){}

    public function register(UserRequestDto $dto)
    {
   $user= new User($dto->username, $dto->password);
    $hashed = $this->hasher->hashPassword($user, $dto->password);
    $user->setPassword($hashed);
    $this->repository->save($user);

    }

}