<?php

namespace App\Repository;

use App\Entity\BusinessCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BusinessCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method BusinessCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method BusinessCard[]    findAll()
 * @method BusinessCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BusinessCardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BusinessCard::class);
    }

    // /**
    //  * @return BusinessCard[] Returns an array of BusinessCard objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BusinessCard
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
