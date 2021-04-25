<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CotypeController extends AbstractController
{
    /**
     * @Route("/cotype", name="cotype")
     */
    public function index(): Response
    {
        return $this->render('cotype/index.html.twig', [
            'controller_name' => 'CotypeController',
        ]);
    }
}
