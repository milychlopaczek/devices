<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Devices;
use App\Repository\DevicesRepository;
use App\Repository\CompaniesRepository;
use App\Repository\UsersRepository;

class RowController extends AbstractController{

    /**
     * Undocumented function
     *@Route("/deletion/{id}", name="row_deletion")
     */
    public function delete(DevicesRepository $repository, $id)
    {
        $repository->DeleteRow($id);
        //$repository->UpdateId();

            return $this->redirectToRoute('app_show');
    }
    /**
     * Undocumented function
     *@Route("/edit/{id}", name="row_edition")
     */
    public function edit($id, DevicesRepository $repository)
    {

        $result=$repository->findOneBy(array('device_id'=>$id));
        return $this->render('question/edition.html.twig', ['id'=>$id, 'name'=>$result->getName(), 'CompanyName'=>$result->getCompanyName(), 'ExpiryDate'=>$result->getExpiryDate()->format('Y-m-d') , 'Status'=>$result->getStatus()]);
    }
    /**
     * Undocumented function
     *@Route("/update/{id}", name="row_update")
     */
    public function update(DevicesRepository $repository, $id)
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $device_name= $_POST["name"];
            $company_name= $_POST["CompanyName"];
            $ExpiryDatestring= $_POST["expiryDate"];
            $Status= $_POST["Status"];
        }
            $repository->EditRow($id, $device_name, $company_name, $ExpiryDatestring, $Status);

            return $this->redirectToRoute('app_show');
    }
    /**
     * Undocumented function
     *@Route("/user_deletion/{id}", name="user_deletion")
     */
    public function user_delete(UsersRepository $repository, $id)
    {
        $repository->delete_cascade($id);
        //$repository->UpdateId();

            return $this->redirectToRoute('user_show');
    }
    /**
     * Undocumented function
     *@Route("/user_edit/{id}", name="user_edition")
     */
    public function user_edit($id, UsersRepository $repository)
    {   
                $result=$repository->findOneBy(array('user_id'=>$id));
            return $this->render('question/user_edition.html.twig', ['id'=>$id, 'name'=>$result->getName(), 'lastname'=>$result->getLastName(), 'position'=>$result->getPosition()]);
    }
    /**
     * Undocumented function
     *@Route("/user_update/{id}", name="user_update")
     */
    public function user_update(UsersRepository $repository, $id)
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $user_name= $_POST["name"];
            $last_name= $_POST["LastName"];
            $Position= $_POST["Status"];
        }
            $repository->EditRow($id, $user_name, $last_name, $Position);

            return $this->redirectToRoute('user_show');
    }
}
