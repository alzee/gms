<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GemtypeController extends AbstractController
{
    /**
     * @Route("/gemtype", name="gemtype")
     */
    public function index(): Response
    {
        return $this->render('gemtype/index.html.twig', [
            'controller_name' => 'GemtypeController',
        ]);
    }
}
