<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WorkerController extends AbstractController
{
    /**
     * @Route("/worker", name="worker")
     */
    public function index(): Response
    {
        return $this->render('worker/index.html.twig', [
            'controller_name' => 'WorkerController',
        ]);
    }
}
