<?php

namespace App\Repository;

use App\Entity\Prodtype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Prodtype|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prodtype|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prodtype[]    findAll()
 * @method Prodtype[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProdtypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prodtype::class);
    }

    // /**
    //  * @return Prodtype[] Returns an array of Prodtype objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Prodtype
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
