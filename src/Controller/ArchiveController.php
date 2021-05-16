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
                ['name' => 'division'],
                ['name' => 'craft'],
                ['name' => 'team'],
                ['name' => 'wn'],
                ['name' => 'artisan'],
                ['name' => 'goldclass'],
                ['name' => 'position'],
                ['name' => 'date'],
                ['name' => 'company'],
                ['name' => 'child'],
                ['name' => 'upstreamDoc'],
                ['name' => 'countChild'],
                ['name' => 'note'],
                ['name' => 'prodtype'],
                ['name' => 'line'],
                ['name' => 'model'],
                ['name' => 'seq'],
                ['name' => 'transtype'],
                ['name' => 'op'],
                ['name' => 'lossrate'],
                ['name' => 'weightBooked'],
                ['name' => 'weightGold'],
                ['name' => 'weight'],
                ['name' => 'transreason'],
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
                ['name' => 'division'],
                ['name' => 'craft'],
                ['name' => 'team'],
                ['name' => 'artisan'],
                ['name' => 'child'],
                ['name' => 'upstreamDoc'],
                ['name' => 'goldclass'],
                ['name' => 'dueDate'],
                ['name' => 'jewelry'],
                ['name' => 'countPiece'],
                ['name' => 'series'],
                ['name' => 'granule'],
                ['name' => 'embed'],
                ['name' => 'weightAttach'],
                ['name' => 'weightGold'],
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
                ['name' => 'shouhuopihao'],
                ['name' => 'child'],
                ['name' => 'doctype'],
                ['name' => 'cotype'],
                ['name' => 'model'],
                ['name' => 'note'],
                ['name' => 'factory'],
                ['name' => 'seq'],
                ['name' => 'jewelry'],
                ['name' => 'division'],
                ['name' => 'craft'],
                ['name' => 'team'],
                ['name' => 'artisan'],
                ['name' => 'craft'],
                ['name' => 'goldclass'],
                ['name' => 'countPiece'],
                ['name' => 'weightGold'],
                ['name' => 'weight'],
                ['name' => 'size'],
                ['name' => 'loss'],
                ['name' => 'wageId'],
                ['name' => 'wage'],
                ['name' => 'wageExtra'],
                ['name' => 'wageTotal'],
                ['name' => 'whyExtra'],
                ['name' => 'date'],
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
                ['name' => 'division'],
                ['name' => 'craft'],
                ['name' => 'team'],
                ['name' => 'stafftype'],
                ['name' => 'staff'],
                ['name' => 'position'],
                ['name' => 'goldclass'],
                ['name' => 'balance'],
                ['name' => 'lossAccum'],
                ['name' => 'balanceDoc'],
                ['name' => 'balancePiece'],
                ['name' => 'weightHolding'],
            ]
        ]);
    }
}
