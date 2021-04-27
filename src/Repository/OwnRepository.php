<?php

namespace App\Repository;

use App\Entity\Own;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Own|null find($id, $lockMode = null, $lockVersion = null)
 * @method Own|null findOneBy(array $criteria, array $orderBy = null)
 * @method Own[]    findAll()
 * @method Own[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OwnRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Own::class);
    }

    // /**
    //  * @return Own[] Returns an array of Own objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Own
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
