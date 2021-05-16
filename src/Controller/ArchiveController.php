<?php

namespace App\Controller;

use App\Entity\Main;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function trans(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select m from App\Entity\Main m order by m.id desc";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);
        $p = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('archive/index.html.twig', [
            'page' => 'trans',
            'items' => $p,
            'filters' => ['m.sn' => 'sn'],
            'columns' => [
                ['name' => 'sn', 'sort' => 'm.sn'],
                ['name' => 'date', 'sort' => 'm.date'],
                ['name' => 'dueDate', 'sort' => 'm.dueDate'],
                ['name' => 'countChild'],
                ['name' => 'countPiece'],
                ['name' => 'perWeight'],
                ['name' => 'totalWeight'],
                ['name' => 'upstreamDoc'],
                ['name' => 'model'],
                ['name' => 'stamp'],
                ['name' => 'size'],
                ['name' => 'note'],
            ]
        ]);
    }

    /**
     * @Route("/holding", name="archive_holding")
     */
    public function holding(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select m from App\Entity\Main m order by m.id desc";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);
        $p = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('archive/index.html.twig', [
            'page' => 'holding',
            'items' => $p,
            'filters' => ['m.sn' => 'sn'],
            'columns' => [
                ['name' => 'sn', 'sort' => 'm.sn'],
                ['name' => 'date', 'sort' => 'm.date'],
                ['name' => 'dueDate', 'sort' => 'm.dueDate'],
                ['name' => 'countChild'],
                ['name' => 'countPiece'],
                ['name' => 'perWeight'],
                ['name' => 'totalWeight'],
                ['name' => 'upstreamDoc'],
                ['name' => 'model'],
                ['name' => 'stamp'],
                ['name' => 'size'],
                ['name' => 'note'],
            ]
        ]);
    }

    /**
     * @Route("/wage", name="archive_wage")
     */
    public function wage(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select m from App\Entity\Main m order by m.id desc";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);
        $p = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('archive/index.html.twig', [
            'page' => 'wage',
            'items' => $p,
            'filters' => ['m.sn' => 'sn'],
            'columns' => [
                ['name' => 'sn', 'sort' => 'm.sn'],
                ['name' => 'date', 'sort' => 'm.date'],
                ['name' => 'dueDate', 'sort' => 'm.dueDate'],
                ['name' => 'countChild'],
                ['name' => 'countPiece'],
                ['name' => 'perWeight'],
                ['name' => 'totalWeight'],
                ['name' => 'upstreamDoc'],
                ['name' => 'model'],
                ['name' => 'stamp'],
                ['name' => 'size'],
                ['name' => 'note'],
            ]
        ]);
    }

    /**
     * @Route("/balance", name="archive_balance")
     */
    public function balance(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select m from App\Entity\Main m order by m.id desc";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);
        $p = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('archive/index.html.twig', [
            'page' => 'balance',
            'items' => $p,
            'filters' => ['m.sn' => 'sn'],
            'columns' => [
                ['name' => 'sn', 'sort' => 'm.sn'],
                ['name' => 'date', 'sort' => 'm.date'],
                ['name' => 'dueDate', 'sort' => 'm.dueDate'],
                ['name' => 'countChild'],
                ['name' => 'countPiece'],
                ['name' => 'perWeight'],
                ['name' => 'totalWeight'],
                ['name' => 'upstreamDoc'],
                ['name' => 'model'],
                ['name' => 'stamp'],
                ['name' => 'size'],
                ['name' => 'note'],
            ]
        ]);
    }
}
