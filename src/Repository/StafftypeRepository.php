<?php

namespace App\Repository;

use App\Entity\Stafftype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stafftype|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stafftype|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stafftype[]    findAll()
 * @method Stafftype[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StafftypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stafftype::class);
    }

    // /**
    //  * @return Stafftype[] Returns an array of Stafftype objects
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
    public function findOneBySomeField($value): ?Stafftype
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
