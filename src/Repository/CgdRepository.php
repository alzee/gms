<?php

namespace App\Repository;

use App\Entity\Cgd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cgd|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cgd|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cgd[]    findAll()
 * @method Cgd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CgdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cgd::class);
    }

    // /**
    //  * @return Cgd[] Returns an array of Cgd objects
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
    public function findOneBySomeField($value): ?Cgd
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
