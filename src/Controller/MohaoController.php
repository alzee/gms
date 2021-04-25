<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MohaoController extends AbstractController
{
    /**
     * @Route("/mohao", name="mohao")
     */
    public function index(): Response
    {
        return $this->render('mohao/index.html.twig', [
            'controller_name' => 'MohaoController',
        ]);
    }
}
