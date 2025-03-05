<?php

namespace App\Controller;


use App\Repository\UserRepository;
use App\Service\AdminService;
use FOS\RestBundle\Controller\AbstractFOSRestController as Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\RequestParam;
#[Rest\Route(path:'/api/admin')]
class AdminController extends Controller
{
    #[Rest\Post]
    public function makeAdmin(string $username, AdminService $service, UserRepository $userRepository)
    {
        
        $user = $userRepository->findOneBy(['username' => $username]);
        $service->makeAdmin($user);
        return $this->json(["message" => "o usuário de email {$user->getUsername()}"]);
    }


}