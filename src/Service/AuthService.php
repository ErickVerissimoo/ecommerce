<?php

namespace App\Service;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\OrderBy;

class AuthService
{
    public function __construct(private UserRepository $repository) {
        
    }
    public function login(string $username, string $password): bool{
        $achou = $this->repository->findBy(["username"=> $username,"password"=> $password])? true:false ;
        


        return $achou;
    }
    

}