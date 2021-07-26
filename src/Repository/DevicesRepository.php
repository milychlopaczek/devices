<?php

namespace App\Repository;

use App\Entity\Devices;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Devices|null find($id, $lockMode = null, $lockVersion = null)
 * @method Devices|null findOneBy(array $criteria, array $orderBy = null)
 * @method Devices[]    findAll()
 * @method Devices[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DevicesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Devices::class);
    }

    public function DeleteRow($id)
    {
        return $this->createQueryBuilder('d')
            ->delete()
            ->andWhere('d.device_id= :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;
    }
    public function UpdateId()
    {
        $sql ='SET  @num := 0;

        UPDATE devices SET device_id = @num := (@num+1);
        
        ALTER TABLE devices AUTO_INCREMENT =1;';
        $conn=$this->getEntityManager()->getConnection();
        $stmt =$conn->prepare($sql);
        $stmt->executeQuery();
    }

    /*
    public function findOneBySomeField($value): ?Devices
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
