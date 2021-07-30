<?php

namespace App\Controller;

use App\Service\MarkdownHelper;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use App\Entity\Devices;
use App\Repository\DevicesRepository;
use App\Repository\DeviceUsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class issuesController extends AbstractController{

    /**
     * Undocumented function
     *@Route("/issues/{id}", name="device_issues")
     */
    public function show(DevicesRepository $repository, $id, DeviceUsersRepository $du_repo)
    {
        
        $issues=$repository->showIssues($id);
        $specs=$repository->device_users($id)->fetchAllAssociative();
        return $this->render('question/issues.html.twig', ['issues'=>$issues, 'specs'=>$specs]);
    }
}
