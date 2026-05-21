<?php

namespace App\Controller\Api;

use App\Repository\PasswordCreationTokenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class PasswordCreationController
{
    #[Route('/api/password/create', name: 'api_password_create', methods: ['POST'])]
    public function create(
        Request $request,
        PasswordCreationTokenRepository $tokenRepository,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['token'], $data['password'])) {
            return new JsonResponse(['error' => 'Données invalides'], 400);
        }

        $token = $tokenRepository->findOneBy(['token' => $data['token']]);

        if (!$token || $token->isUsed() || $token->isExpired()) {
            return new JsonResponse(['error' => 'Token invalide ou expiré'], 400);
        }

        $user = $token->getClient();
        $hashedPassword = $passwordHasher->hashPassword($user, $data['password']);

        $user->setPassword($hashedPassword);
        $token->setIsUsed(true);

        $em->flush();

        return new JsonResponse(['success' => true]);
    }
}