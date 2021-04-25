<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JewelrytypeController extends AbstractController
{
    /**
     * @Route("/jewelrytype", name="jewelrytype")
     */
    public function index(): Response
    {
        return $this->render('jewelrytype/index.html.twig', [
            'controller_name' => 'JewelrytypeController',
        ]);
    }
}
