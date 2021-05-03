<?php

namespace App\Repository;

use App\Entity\Cc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cc|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cc|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cc[]    findAll()
 * @method Cc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CcRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cc::class);
    }

    public function toMe($clerk)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.recipient = :val')
            ->setParameter('val', $clerk)
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(50)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Cc[] Returns an array of Cc objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cc
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
