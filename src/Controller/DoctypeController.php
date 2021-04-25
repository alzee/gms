<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DoctypeController extends AbstractController
{
    /**
     * @Route("/doctype", name="doctype")
     */
    public function index(): Response
    {
        return $this->render('doctype/index.html.twig', [
            'controller_name' => 'DoctypeController',
        ]);
    }
}
