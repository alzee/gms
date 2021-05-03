<?php

namespace App\Repository;

use App\Entity\Subtractreason;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Subtractreason|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subtractreason|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subtractreason[]    findAll()
 * @method Subtractreason[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubtractreasonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subtractreason::class);
    }

    // /**
    //  * @return Subtractreason[] Returns an array of Subtractreason objects
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
    public function findOneBySomeField($value): ?Subtractreason
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
