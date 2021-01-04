<?php

namespace App\Repository;

use App\Entity\Saga;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Saga|null find($id, $lockMode = null, $lockVersion = null)
 * @method Saga|null findOneBy(array $criteria, array $orderBy = null)
 * @method Saga[]    findAll()
 * @method Saga[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SagaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Saga::class);
    }

    // /**
    //  * @return Saga[] Returns an array of Saga objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Saga
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
