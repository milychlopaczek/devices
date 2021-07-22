<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class formularz extends AbstractController
{
    /**
     * Undocumented function
     *@Route("/formularz", name="add_device")
     */
    public function add()
    {
        return $this->render('/question/formularz.html.twig');
    }
    /**
     * Undocumented function
     *@Route("/formularz", name="insert")
     * @return void
     */
    public function insert()
    {
        echo "lol";
    }
}