<?php

namespace App\Controller;

use App\Dto\UserRequestDto;
use App\Service\AuthService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Post;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class AuthController extends AbstractFOSRestController
{
     public function __construct(private AuthService $authService) {}
     
#[Post(path:"/api/register")]
    public function register(#[MapRequestPayload] UserRequestDto $dto): JsonResponse
    {
        $this->authService->register(dto: $dto);
        return $this->json(
["message" => "user registered"], Response::HTTP_CREATED

        );
    }
}