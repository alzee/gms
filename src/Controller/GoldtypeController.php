<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GoldtypeController extends AbstractController
{
    /**
     * @Route("/goldtype", name="goldtype")
     */
    public function index(): Response
    {
        return $this->render('goldtype/index.html.twig', [
            'controller_name' => 'GoldtypeController',
        ]);
    }
}
