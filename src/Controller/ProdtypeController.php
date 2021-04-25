<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProdtypeController extends AbstractController
{
    /**
     * @Route("/prodtype", name="prodtype")
     */
    public function index(): Response
    {
        return $this->render('prodtype/index.html.twig', [
            'controller_name' => 'ProdtypeController',
        ]);
    }
}
