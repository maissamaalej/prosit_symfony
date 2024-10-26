<?php

namespace App\Repository;

use App\Entity\TheatrePlay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TheatrePlay>
 */
class TheatrePlayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TheatrePlay::class);
    }
    public function triPar_title()
   { return $this->createQueryBuilder('t')

    ->orderBy('t.title', 'DESC')
    ->getQuery()
    ->getResult();
   }

   public function triPar_duration()
   { return $this->createQueryBuilder('s')
    ->orderBy('s.duration', 'DESC')
    ->getQuery()
    ->getResult();
   }
   public function TotalNumber ($id)   
   {
    $query = $this->entityManager->createQuery('SELECT COUNT(s.id) FROM App\Entity\Show s WHERE s.play = :playId')->setParameter('playId', $playId);
    return $query->getSingleScalarResult();
 }

   
    //    /**
    //     * @return TheatrePlay[] Returns an array of TheatrePlay objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?TheatrePlay
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
