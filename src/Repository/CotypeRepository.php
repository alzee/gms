<?php

namespace App\Repository;

use App\Entity\Cotype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cotype|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cotype|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cotype[]    findAll()
 * @method Cotype[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CotypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cotype::class);
    }

    // /**
    //  * @return Cotype[] Returns an array of Cotype objects
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
    public function findOneBySomeField($value): ?Cotype
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
