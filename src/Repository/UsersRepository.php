<?php

namespace App\Repository;

use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Users|null find($id, $lockMode = null, $lockVersion = null)
 * @method Users|null findOneBy(array $criteria, array $orderBy = null)
 * @method Users[]    findAll()
 * @method Users[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
    }

    public function delete_cascade($id)
    {
        $sql ="DELETE FROM users WHERE user_id=$id;";
        $conn=$this->getEntityManager()->getConnection();
        $stmt =$conn->prepare($sql);
        $stmt->executeQuery();
    }
    public function UpdateId()
    {
        $sql ='
        SET FOREIGN_KEY_CHECKS=0;
        SET  @num := 0;

        UPDATE users SET user_id = @num := (@num+1);
        
        ALTER TABLE users AUTO_INCREMENT =1;
        SET FOREIGN_KEY_CHECKS=1;';
        $conn=$this->getEntityManager()->getConnection();
        $stmt =$conn->prepare($sql);
        $stmt->executeQuery();
    }
    public function EditRow($id, $name, $lastName, $position)
    {
        return $this->createQueryBuilder('u')
            ->update()
            ->set('u.name', ':name')
            ->set('u.lastname', ':LastName')
            ->set('u.position', ':Position')
            ->andWhere('u.user_id=:id')
            ->setParameter('id', $id)
            ->setParameter('name', $name)
            ->setParameter('LastName', $lastName)
            ->setParameter('Position', $position)
            ->getQuery()
            ->getResult();
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
