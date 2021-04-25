<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InsertController extends AbstractController
{
    /**
     * @Route("/insert", name="insert")
     */
    public function index(): Response
    {
        return $this->render('insert/index.html.twig', [
            'controller_name' => 'InsertController',
        ]);
    }
}
