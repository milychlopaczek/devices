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
    public function delete_prepare()
    {
        $sql ="ALTER TABLE `device_users`
        ADD CONSTRAINT `device_users_ibfk_3`
        FOREIGN KEY (`device_id`) REFERENCES `devices` (`device_id`)
        ON DELETE CASCADE;";
        $conn=$this->getEntityManager()->getConnection();
        $stmt =$conn->prepare($sql);
        $stmt->executeQuery();
    }
    public function DeleteRow($id)
    {
        $sql ="DELETE FROM devices WHERE device_id=$id;";
        $conn=$this->getEntityManager()->getConnection();
        $stmt =$conn->prepare($sql);
        $stmt->executeQuery();
    }
    /**
     * Undocumented function
     *
     * @return Device
     */
    public function UpdateId()
    {
        $sql ='SET FOREIGN_KEY_CHECKS=0;
        SET  @num := 0;

        UPDATE devices SET device_id = @num := (@num+1);
        
        ALTER TABLE devices AUTO_INCREMENT =1;
        SET FOREIGN_KEY_CHECKS=1;';
        $conn=$this->getEntityManager()->getConnection();
        $stmt =$conn->prepare($sql);
        $stmt->executeQuery();
    }
    public function showIssues($id)
    {
        return $this->createQueryBuilder('d')
            ->select()
            ->andWhere('d.device_id=:id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
    public function EditRow($id, $name, $companyName, $ExpiryDate, $status)
    {
        return $this->createQueryBuilder('d')
            ->update()
            ->set('d.name', ':name')
            ->set('d.companyName', ':CompanyName')
            ->set('d.expiry_date', ':ExpiryDate')
            ->set('d.status', ':Status')
            ->andWhere('d.device_id=:id')
            ->setParameter('id', $id)
            ->setParameter('name', $name)
            ->setParameter('CompanyName', $companyName)
            ->setParameter('ExpiryDate', $ExpiryDate)
            ->setParameter('Status', $status)
            ->getQuery()
            ->getResult();
    }
    public function device_users($id)
    {
        /*return $this->createQueryBuilder('du')
            ->andWhere('du.device_id=:id')
            ->innerJoin('du.user_id', 'u')
            ->setParameter('id', $id)
            ->getQuery()
            ->execute();*/
            $sql="SELECT device_users.device_users_id, devices.device_id, users.user_id, devices.name, users.name, device_users.start_date, device_users.end_date
            FROM ((devices
            INNER JOIN device_users ON device_users.device_id = devices.device_id)
            INNER JOIN users ON users.user_id = device_users.user_id)
            WHERE devices.device_id=$id
            ORDER BY device_users.start_date;";
            $conn=$this->getEntityManager()->getConnection();
            $stmt =$conn->prepare($sql);
            //dd($stmt);
            return $stmt->executeQuery();


    }
    public function showall()
    {
        /*return $this->createQueryBuilder('du')
            ->andWhere('du.device_id=:id')
            ->innerJoin('du.user_id', 'u')
            ->setParameter('id', $id)
            ->getQuery()
            ->execute();*/
            $sql="SELECT * FROM devices;";
            $conn=$this->getEntityManager()->getConnection();
            $stmt =$conn->prepare($sql);
            //dd($stmt);
            return $stmt->executeQuery();

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
