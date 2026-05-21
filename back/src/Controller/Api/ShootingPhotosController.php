<?php

namespace App\Controller\Api;

use App\Entity\Photo;
use App\Repository\PhotoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShootingPhotosController extends AbstractController
{
    #[Route('/api/shootings/{id}/photos', methods: ['GET'])]
    public function __invoke(
        int $id,
        Request $request,
        PhotoRepository $repo,
        EntityManagerInterface $em
    ): JsonResponse {

        $page = max(1, $request->query->getInt('page', 1));
        $limit = min(50, $request->query->getInt('limit', 20));

        $offset = ($page - 1) * $limit;

        $qb = $em->createQueryBuilder();

        $total = $qb->select('COUNT(p.id)')
            ->from(Photo::class, 'p')
            ->where('p.shooting = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult();

        $photos = $repo->findPaginatedByShooting(
            $id,
            $limit,
            $offset
        );

        $data = array_map(
            fn($photo) => [
                'id' => $photo->getId(),
                'imageUrl' => $photo->getImageUrl(),
            ],
            $photos
        );

        return $this->json([
            'data' => $data,
            'page' => $page,
            'limit' => $limit,
            'total' => (int) $total,
        ]);
    }
}