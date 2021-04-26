<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/stock", name="stock")
 */
class StockController extends AbstractController
{
    /**
     * @Route("/", name="stock")
     */
    public function index(): Response
    {
        return $this->render('stock/index.html.twig', [
            'controller_name' => 'StockController',
        ]);
    }

    /**
     * @Route("/new", name="stock_new")
     */
    public function new(): Response
    {
        return $this->render('stock/new.html.twig', [
            'controller_name' => 'StockController',
        ]);
    }
}
