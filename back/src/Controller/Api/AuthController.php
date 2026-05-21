<?php

namespace App\Controller\Api;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController
{
    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login(): JsonResponse
    {
        return new JsonResponse(['message' => 'handled by firewall']);
    }
}