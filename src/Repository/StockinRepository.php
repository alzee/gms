<?php

namespace App\Repository;

use App\Entity\Stockin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stockin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stockin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stockin[]    findAll()
 * @method Stockin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stockin::class);
    }

    // /**
    //  * @return Stockin[] Returns an array of Stockin objects
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
    public function findOneBySomeField($value): ?Stockin
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
