<?php

namespace App\Controller;

use App\Dto\UserRequestDto;
use App\Service\AuthService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as controlador;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route as rota;

class AuthController extends AbstractFOSRestController
{
    public function __construct(private AuthService $authService) {}
#[Post(path:"/api/register")]
    public function register(UserRequestDto $dto): JsonResponse
    {
        $this->authService->register(dto: $dto);
        return new JsonResponse(
["message" => "user registered"], Response::HTTP_CREATED

        );
    }
}