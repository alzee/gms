<?php

namespace App\Repository;

use App\Entity\Gd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gd|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gd|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gd[]    findAll()
 * @method Gd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gd::class);
    }

    // /**
    //  * @return Gd[] Returns an array of Gd objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gd
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
