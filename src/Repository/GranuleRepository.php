<?php

namespace App\Repository;

use App\Entity\Granule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Granule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Granule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Granule[]    findAll()
 * @method Granule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GranuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Granule::class);
    }

    // /**
    //  * @return Granule[] Returns an array of Granule objects
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
    public function findOneBySomeField($value): ?Granule
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
