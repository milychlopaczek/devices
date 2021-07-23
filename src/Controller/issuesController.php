<?php

namespace App\Controller;

use App\Service\MarkdownHelper;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use App\Entity\Devices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class issuesController extends AbstractController{

    /**
     * Undocumented function
     *@Route("/issues/{id}", name="device_issues")
     */
    public function show(EntityManagerInterface $entityManager, $id)
    {
        $repository=$entityManager->getRepository(Devices::class);
        $result=$repository->findAll();
        $query =$entityManager->createQueryBuilder();
        $query
            ->select('u.device_id', 'u.name', 'u.company_name', 'u.expiry_date', 'u.status')
            ->from('Devices', 'u');

        return $this->render('question/issues.html.twig');
    }
}
