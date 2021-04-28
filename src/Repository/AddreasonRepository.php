<?php

namespace App\Repository;

use App\Entity\Addreason;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Addreason|null find($id, $lockMode = null, $lockVersion = null)
 * @method Addreason|null findOneBy(array $criteria, array $orderBy = null)
 * @method Addreason[]    findAll()
 * @method Addreason[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddreasonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Addreason::class);
    }

    // /**
    //  * @return Addreason[] Returns an array of Addreason objects
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
    public function findOneBySomeField($value): ?Addreason
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
