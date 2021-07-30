<?php

namespace App\Controller;

use App\Entity\Devices;
use App\Entity\DeviceUsers;
use App\Entity\Users;
use App\Repository\DevicesRepository;
use App\Repository\DeviceUsersRepository;
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
    /**
     * Undocumented function
     *@Route("/DeviceUserForm/{id}", name="add_user_device")
     */
    public function device_user_add($id)
    {
        return $this->render('/question/user_device_form.html.twig', ['id'=>$id]);
    }
    /**
     * Undocumented function
     *@Route("/UserInsert/{id}", name="device_user_insert")
     * @return void
     */
    public function device_user_insert(DeviceUsersRepository $repository, $id)
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $user_id= $_POST["userId"];
            //dd($user_id);
            $device_id=$id;
            $start_date= $_POST["startDate"];
            $end_date= $_POST["startDate"];
            $start_date="'".$start_date."'";
            $end_date="'".$end_date."'";
            //$startdate = \DateTime::createFromFormat('Y-m-d', $start_date);
            //$enddate = \DateTime::createFromFormat('Y-m-d', $end_date);
            $repository->insertdata($device_id, $user_id, $end_date, $start_date);
        }
        //dd($ExpiryDatestring);
        return $this->redirectToRoute('device_issues', array('id'=>$id));
    }
}