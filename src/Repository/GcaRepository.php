<?php

namespace App\Repository;

use App\Entity\Gca;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gca|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gca|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gca[]    findAll()
 * @method Gca[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GcaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gca::class);
    }

    // /**
    //  * @return Gca[] Returns an array of Gca objects
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
    public function findOneBySomeField($value): ?Gca
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
