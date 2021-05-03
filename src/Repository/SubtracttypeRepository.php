<?php

namespace App\Repository;

use App\Entity\Subtracttype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Subtracttype|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subtracttype|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subtracttype[]    findAll()
 * @method Subtracttype[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubtracttypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subtracttype::class);
    }

    // /**
    //  * @return Subtracttype[] Returns an array of Subtracttype objects
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
    public function findOneBySomeField($value): ?Subtracttype
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
