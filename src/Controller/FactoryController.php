<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FactoryController extends AbstractController
{
    /**
     * @Route("/factory", name="factory")
     */
    public function index(): Response
    {
        return $this->render('factory/index.html.twig', [
            'controller_name' => 'FactoryController',
        ]);
    }
}
