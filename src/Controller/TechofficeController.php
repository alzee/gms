<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TechofficeController extends AbstractController
{
    /**
     * @Route("/techoffice", name="techoffice")
     */
    public function index(): Response
    {
        return $this->render('techoffice/index.html.twig', [
            'controller_name' => 'TechofficeController',
        ]);
    }
}
