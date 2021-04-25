<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProdypeController extends AbstractController
{
    /**
     * @Route("/prodype", name="prodype")
     */
    public function index(): Response
    {
        return $this->render('prodype/index.html.twig', [
            'controller_name' => 'ProdypeController',
        ]);
    }
}
