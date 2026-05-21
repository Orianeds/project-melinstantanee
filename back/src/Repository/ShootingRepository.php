<?php

namespace App\Repository;

use App\Entity\Shooting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Shooting>
 */
class ShootingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shooting::class);
    }

    public function findPublishedBySlug(string $slug): ?Shooting
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.slug = :slug')
            ->andWhere('s.isPublished = true')
            ->setParameter('slug', $slug)
            ->leftJoin('s.photos', 'p')
            ->addSelect('p')
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findOneByToken(string $token): ?Shooting
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.galleryToken = :token')
            ->setParameter('token', $token)
            ->getQuery()
            ->getOneOrNullResult();
    }

    //    /**
    //     * @return Shooting[] Returns an array of Shooting objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Shooting
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
