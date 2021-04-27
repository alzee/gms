<?php

namespace App\Repository;

use App\Entity\Wage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Wage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wage[]    findAll()
 * @method Wage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wage::class);
    }

    // /**
    //  * @return Wage[] Returns an array of Wage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Wage
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
