<?php

namespace App\Repository;

use App\Entity\Addtype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Addtype|null find($id, $lockMode = null, $lockVersion = null)
 * @method Addtype|null findOneBy(array $criteria, array $orderBy = null)
 * @method Addtype[]    findAll()
 * @method Addtype[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddtypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Addtype::class);
    }

    // /**
    //  * @return Addtype[] Returns an array of Addtype objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Addtype
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
