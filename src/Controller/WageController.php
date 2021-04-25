<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WageController extends AbstractController
{
    /**
     * @Route("/wage", name="wage")
     */
    public function index(): Response
    {
        return $this->render('wage/index.html.twig', [
            'controller_name' => 'WageController',
        ]);
    }
}
