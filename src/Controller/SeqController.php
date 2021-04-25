<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeqController extends AbstractController
{
    /**
     * @Route("/seq", name="seq")
     */
    public function index(): Response
    {
        return $this->render('seq/index.html.twig', [
            'controller_name' => 'SeqController',
        ]);
    }
}
