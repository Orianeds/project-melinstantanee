<?php

namespace App\Controller\Api;

use App\Mapper\ShootingGalleryMapper;
use App\Repository\ShootingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ShootingGalleryController extends AbstractController
{
    #[Route('/api/shootings/{id}/gallery', methods: ['GET'])]
    public function __invoke(
        int $id,
        ShootingRepository $repo,
        ShootingGalleryMapper $mapper
    ): JsonResponse {
        $shooting = $repo->find($id);

        if (!$shooting) {
            return $this->json([
                'error' => 'Shooting non trouvé'
            ], 404);
        }

        return $this->json(
            $mapper->toDto($shooting)
        );
    }
}