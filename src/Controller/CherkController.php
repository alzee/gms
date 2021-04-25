<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CherkController extends AbstractController
{
    /**
     * @Route("/cherk", name="cherk")
     */
    public function index(): Response
    {
        return $this->render('cherk/index.html.twig', [
            'controller_name' => 'CherkController',
        ]);
    }
}
