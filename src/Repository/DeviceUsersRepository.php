<?php

namespace App\Repository;

use App\Entity\DeviceUsers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Stmt;

/**
 * @method DeviceUsers|null find($id, $lockMode = null, $lockVersion = null)
 * @method DeviceUsers|null findOneBy(array $criteria, array $orderBy = null)
 * @method DeviceUsers[]    findAll()
 * @method DeviceUsers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeviceUsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeviceUsers::class);
    }
    public function insertdata($device_id, $user_id, $enddate, $startdate)
    {
        $sql ="INSERT INTO device_users (user_id, device_id, start_date, end_date) VALUES ($user_id, $device_id, $startdate, $enddate);";
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
