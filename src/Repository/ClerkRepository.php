<?php

namespace App\Repository;

use App\Entity\Clerk;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Clerk|null find($id, $lockMode = null, $lockVersion = null)
 * @method Clerk|null findOneBy(array $criteria, array $orderBy = null)
 * @method Clerk[]    findAll()
 * @method Clerk[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClerkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Clerk::class);
    }

    // /**
    //  * @return Clerk[] Returns an array of Clerk objects
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
    public function findOneBySomeField($value): ?Clerk
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
