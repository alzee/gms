<?php

namespace App\Repository;

use App\Entity\Gac;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gac|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gac|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gac[]    findAll()
 * @method Gac[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GacRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gac::class);
    }

    // /**
    //  * @return Gac[] Returns an array of Gac objects
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
    public function findOneBySomeField($value): ?Gac
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
