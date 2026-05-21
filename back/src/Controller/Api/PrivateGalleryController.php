<?php

namespace App\Controller\Api;

use App\Mapper\ShootingGalleryMapper;
use App\Repository\ShootingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PrivateGalleryController extends AbstractController
{
    #[Route('/api/gallery/{token}', methods: ['GET'])]
    public function __invoke(
        string $token,
        ShootingRepository $repo,
        ShootingGalleryMapper $mapper
    ): JsonResponse {

        $shooting = $repo->findOneByToken($token);

        if (!$shooting) {
            return $this->json([
                'error' => 'Galerie non trouvée'
            ], 404);
        }

        return $this->json(
            $mapper->toDto($shooting)
        );
    }
}