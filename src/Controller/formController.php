<?php

namespace App\Controller;

use App\Entity\Devices;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
class formController extends AbstractController
{
    /**
     * Undocumented function
     *@Route("/formularz", name="add_device")
     */
    public function add()
    {
        return $this->render('/question/form.html.twig');
    }
    /**
     * Undocumented function
     *@Route("/insert", name="insert")
     * @return void
     */
    public function insert(EntityManagerInterface $entityManager)
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $device_name= $_POST["name"];
            $company_name= $_POST["CompanyName"];
            $ExpiryDatestring= $_POST["expiryDate"];
            $Status= $_POST["Status"];
        }
        $ExpiryDate = \DateTime::createFromFormat('Y-m-d', $ExpiryDatestring);
        //dd($ExpiryDatestring);
        $row=new Devices;
        $row->setName($device_name)
            ->setCompanyName($company_name)
            ->setExpiryDate($ExpiryDate)
            ->setStatus($Status);
        $entityManager->persist($row);
        $entityManager->flush();
        //$response =$this->forward('App\Controller\QuestionController::show');
        return $this->redirectToRoute('app_show');
    }
    /**
     * Undocumented function
     *@Route("/add_user", name="add_user")
     */
    public function add_user()
    {
        return $this->render('/question/user_form.html.twig');
    }
    /**
     * Undocumented function
     *@Route("/UserInsert", name="user_insert")
     * @return void
     */
    public function user_insert(EntityManagerInterface $entityManager)
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $user_name= $_POST["name"];
            $last_name= $_POST["LastName"];
            $Position= $_POST["Status"];
        }
        //dd($ExpiryDatestring);
        $row=new Users;
        $row->setName($user_name)
            ->setLastName($last_name)
            ->setPosition($Position);
        $entityManager->persist($row);
        $entityManager->flush();
        return $this->redirectToRoute('user_show');
    }
}