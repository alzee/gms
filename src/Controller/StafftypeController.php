<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StafftypeController extends AbstractController
{
    /**
     * @Route("/stafftype", name="stafftype")
     */
    public function index(): Response
    {
        return $this->render('stafftype/index.html.twig', [
            'controller_name' => 'StafftypeController',
        ]);
    }
}
