<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/transfer", name="transfer")
 */
class TransferController extends AbstractController
{
    /**
     * @Route("/", name="transfer")
     */
    public function index(): Response
    {
        return $this->render('transfer/index.html.twig', [
            'controller_name' => 'TransferController',
        ]);
    }

    /**
     * @Route("/new", name="transfer_new")
     */
    public function new(): Response
    {
        return $this->render('transfer/new.html.twig', [
            'controller_name' => 'TransferController',
        ]);
    }
}
