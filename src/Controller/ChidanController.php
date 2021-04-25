<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChidanController extends AbstractController
{
    /**
     * @Route("/chidan", name="chidan")
     */
    public function index(): Response
    {
        return $this->render('chidan/index.html.twig', [
            'controller_name' => 'ChidanController',
        ]);
    }
}
