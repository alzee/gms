<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LishuController extends AbstractController
{
    /**
     * @Route("/lishu", name="lishu")
     */
    public function index(): Response
    {
        return $this->render('lishu/index.html.twig', [
            'controller_name' => 'LishuController',
        ]);
    }
}
