<?php

namespace App\Repository;

use App\Entity\Doctype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Doctype|null find($id, $lockMode = null, $lockVersion = null)
 * @method Doctype|null findOneBy(array $criteria, array $orderBy = null)
 * @method Doctype[]    findAll()
 * @method Doctype[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Doctype::class);
    }

    // /**
    //  * @return Doctype[] Returns an array of Doctype objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Doctype
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
