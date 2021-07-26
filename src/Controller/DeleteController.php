<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Devices;
use App\Repository\DevicesRepository;
use App\Repository\CompaniesRepository;

class DeleteController extends AbstractController{

    /**
     * Undocumented function
     *@Route("/deletion/{id}", name="row_deletion")
     */
    public function delete(DevicesRepository $repository, $id)
    {
        $repository->DeleteRow($id);
        $repository->UpdateId();

            return $this->redirectToRoute('app_show');
    }

}
