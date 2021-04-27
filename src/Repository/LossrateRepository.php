<?php

namespace App\Repository;

use App\Entity\Lossrate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lossrate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lossrate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lossrate[]    findAll()
 * @method Lossrate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LossrateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lossrate::class);
    }

    // /**
    //  * @return Lossrate[] Returns an array of Lossrate objects
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
    public function findOneBySomeField($value): ?Lossrate
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
