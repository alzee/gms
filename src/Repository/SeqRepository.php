<?php

namespace App\Repository;

use App\Entity\Seq;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Seq|null find($id, $lockMode = null, $lockVersion = null)
 * @method Seq|null findOneBy(array $criteria, array $orderBy = null)
 * @method Seq[]    findAll()
 * @method Seq[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeqRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Seq::class);
    }

    // /**
    //  * @return Seq[] Returns an array of Seq objects
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
    public function findOneBySomeField($value): ?Seq
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
