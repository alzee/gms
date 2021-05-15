<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/archive")
 */
class ArchiveController extends AbstractController
{

    /**
     * @Route("/trans", name="archive_trans")
     */
    public function trans(): Response
    {
        return $this->render('archive/index.html.twig', [
            'controller_name' => 'ArchiveController',
        ]);
    }

    /**
     * @Route("/holding", name="archive_holding")
     */
    public function holding(): Response
    {
        return $this->render('archive/index.html.twig', [
            'controller_name' => 'ArchiveController',
        ]);
    }

    /**
     * @Route("/wage", name="archive_wage")
     */
    public function wage(): Response
    {
        return $this->render('archive/index.html.twig', [
            'controller_name' => 'ArchiveController',
        ]);
    }

    /**
     * @Route("/box", name="archive_box")
     */
    public function box(): Response
    {
        return $this->render('archive/index.html.twig', [
            'controller_name' => 'ArchiveController',
        ]);
    }
}
