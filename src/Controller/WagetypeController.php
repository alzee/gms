<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WagetypeController extends AbstractController
{
    /**
     * @Route("/wagetype", name="wagetype")
     */
    public function index(): Response
    {
        return $this->render('wagetype/index.html.twig', [
            'controller_name' => 'WagetypeController',
        ]);
    }
}
