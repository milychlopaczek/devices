 -<?php

namespace App\Controller;

use App\Service\MarkdownHelper;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use App\Entity\Devices;
use App\Entity\Companies;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteController extends AbstractController{

    /**
     * Undocumented function
     *@Route("/deletion/{id}", name="row_deletion")
     */
    public function delete(EntityManagerInterface $entityManager, $id)
    {
        $query =$entityManager->createQueryBuilder();
        $query->delete("companies");

            return $this->redirectToRoute('app_show');
    }
}
