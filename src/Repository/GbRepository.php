<?php

namespace App\Repository;

use App\Entity\Gb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gb|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gb|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gb[]    findAll()
 * @method Gb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GbRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gb::class);
    }

    // /**
    //  * @return Gb[] Returns an array of Gb objects
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
    public function findOneBySomeField($value): ?Gb
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
