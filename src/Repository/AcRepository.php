<?php

namespace App\Repository;

use App\Entity\Ac;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ac|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ac|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ac[]    findAll()
 * @method Ac[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AcRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ac::class);
    }

    // /**
    //  * @return Ac[] Returns an array of Ac objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ac
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
