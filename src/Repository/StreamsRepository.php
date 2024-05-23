<?php

namespace App\Repository;

use App\Entity\Streams;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @extends ServiceEntityRepository<Streams>
 */
class StreamsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Streams::class);
    }

    //    /**
    //     * @return Streams[] Returns an array of Streams objects
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

    //    public function findOneBySomeField($value): ?Streams
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    public function findStreamsForTomorrow()
{
    $tomorrow = new \DateTime('tomorrow');

    $tomorrow = new \DateTime('tomorrow');

    return $this->createQueryBuilder('s')
        ->andWhere('s.date >= :start_of_day')
        ->where('s.date >= :start_of_day')
        ->andWhere('s.date < :end_of_day')
        ->andWhere('s.date < :end_of_day')
        ->setParameter('start_of_day', $tomorrow->format('Y-m-d 00:00:00'))
        ->setParameter('start_of_day', $tomorrow->format('Y-m-d 00:00:00'))
        ->setParameter('end_of_day', $tomorrow->format('Y-m-d 23:59:59'))
        ->getQuery()
        ->getResult();
}
    public function getEvaluations(): Collection
    {
        $this->evaluations = new ArrayCollection();
        // other initializations...
        return $this->evaluations;
    }
}
