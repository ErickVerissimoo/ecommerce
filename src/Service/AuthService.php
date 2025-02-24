<?php

namespace App\Service;

use App\Dto\UserRequestDto;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\OrderBy;
use Symfony\Component\Serializer\SerializerInterface;

class AuthService
{
    public function __construct(private UserRepository $repository, private SerializerInterface $serializer) {
        
    }
    public function login(string $credentials): bool {
        $entity = $this->serializer->deserialize($credentials, UserRequestDto::class,"json");
        
        $achou = $this->repository->findBy(criteria: ["username"=> $entity->email,"password"=> $entity->password])? true:false ;
        


        return $achou;
    }
    

}