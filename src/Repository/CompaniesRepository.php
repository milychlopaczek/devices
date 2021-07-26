<?php

namespace App\Repository;

use App\Entity\Companies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Companies|null find($id, $lockMode = null, $lockVersion = null)
 * @method Companies|null findOneBy(array $criteria, array $orderBy = null)
 * @method Companies[]    findAll()
 * @method Companies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompaniesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Companies::class);
    }

     /**
      * @return Companies[] Returns an array of Companies objects
      */
    public function findAllOrderedBy()
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.company_id =:val')
            ->setParameter('val', 1)
            ->getQuery()
            ->getResult()
        ;
    }
    public function DeleteRow($id)
    {
        return $this->createQueryBuilder('c')
            ->delete()
            ->andWhere('c.company_id= :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;
    }
    /*
    public function findOneBySomeField($value): ?Companies
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
