<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SelfController extends AbstractController
{
    /**
     * @Route("/self", name="self")
     */
    public function index(): Response
    {
        return $this->render('self/index.html.twig', [
            'controller_name' => 'SelfController',
        ]);
    }
}
