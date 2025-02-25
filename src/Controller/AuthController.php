<?php

namespace App\Controller;

use App\Dto\UserRequestDto;
use App\Dto\UserRequestResolver;
use App\Service\AuthService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as controlador;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\ValueResolver;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route as rota;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\SerializerInterface;

class AuthController extends controlador
{
    public function __construct(private AuthService $authService) {}

#[rota(path:"/api/register", name:"", methods: ["POST"])]
    public function register(#[ValueResolver(UserRequestResolver::class)]UserRequestDto $dto): JsonResponse
    {
        $this->authService->register($dto);
        return new JsonResponse(
["message" => "user registered"]

        );
    }
}