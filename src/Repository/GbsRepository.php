<?php

namespace App\Repository;

use App\Entity\Gbs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gbs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gbs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gbs[]    findAll()
 * @method Gbs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GbsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gbs::class);
    }

    // /**
    //  * @return Gbs[] Returns an array of Gbs objects
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
    public function findOneBySomeField($value): ?Gbs
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
