<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LineController extends AbstractController
{
    /**
     * @Route("/line", name="line")
     */
    public function index(): Response
    {
        return $this->render('line/index.html.twig', [
            'controller_name' => 'LineController',
        ]);
    }
}
