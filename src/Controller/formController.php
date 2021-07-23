<?php

namespace App\Controller;

use App\Entity\Devices;
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
}