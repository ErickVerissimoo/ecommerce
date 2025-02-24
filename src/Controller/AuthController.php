<?php

namespace App\Controller;

use App\Dto\UserRequestDto;
use App\Dto\UserRequestResolver;
use App\Service\AuthService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as controlador;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\ValueResolver;
use Symfony\Component\Routing\Annotation\Route as rota;
use Symfony\Component\Serializer\SerializerInterface;

class AuthController extends controlador
{
    public function __construct(private AuthService $authService) {}
    #[rota(path:"/user/login", name:"login_route", methods: ["POST"])]
    public function login(#[ValueResolver(UserRequestResolver::class)] UserRequestDto $request):JsonResponse{
        return new JsonResponse(
[
    "comequie" => $request->email
]

        );
    }
}