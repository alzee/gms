<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClerkController extends AbstractController
{
    /**
     * @Route("/clerk", name="clerk")
     */
    public function index(): Response
    {
        return $this->render('clerk/index.html.twig', [
            'controller_name' => 'ClerkController',
        ]);
    }
}
