<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SettleController extends AbstractController
{
    /**
     * @Route("/settle", name="settle")
     */
    public function index(): Response
    {
        return $this->render('settle/index.html.twig', [
            'controller_name' => 'SettleController',
        ]);
    }
}
