<?php

namespace App\Repository;

use App\Entity\LivreListe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LivreListe|null find($id, $lockMode = null, $lockVersion = null)
 * @method LivreListe|null findOneBy(array $criteria, array $orderBy = null)
 * @method LivreListe[]    findAll()
 * @method LivreListe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreListeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LivreListe::class);
    }

    // /**
    //  * @return LivreListe[] Returns an array of LivreListe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LivreListe
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
