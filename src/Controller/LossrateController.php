<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LossrateController extends AbstractController
{
    /**
     * @Route("/lossrate", name="lossrate")
     */
    public function index(): Response
    {
        return $this->render('lossrate/index.html.twig', [
            'controller_name' => 'LossrateController',
        ]);
    }
}
