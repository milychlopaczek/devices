<?php

namespace App\Controller;

use App\Service\MarkdownHelper;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use App\Entity\Devices;
use App\Entity\Companies;
use ArrayAccess;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController{
    private $logger;
    private $isDebug;

    public function __construct(LoggerInterface $logger, bool $isDebug)
    {
        $this->logger = $logger;
        $this->isDebug = $isDebug;
    }

    /**
     * Undocumented function
     *@Route("/", name="app_show")
     */
    public function show(EntityManagerInterface $entityManager)
    {
        $repository=$entityManager->getRepository(Devices::class);
        $result=$repository->findAll();
        return $this->render('question/homepage.html.twig', ['Devices' => $result,]);
    }
}
