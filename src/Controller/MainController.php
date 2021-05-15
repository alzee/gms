<?php

namespace App\Controller;

use App\Entity\Main;
use App\Form\MainType;
use App\Repository\MainRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/main")
 */
class MainController extends AbstractController
{
    private $page = 'main';

    /**
     * @Route("/", name="main_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select m from App\Entity\Main m order by m.id desc";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);
        $p = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('crud/index.html.twig', [
            'page' => $this->page,
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
     * @Route("/new", name="main_new", methods={"GET","POST"})
     */
    public function new(Request $request, MainRepository $mainRepository): Response
    {
        $main = new Main();
        $form = $this->createForm(MainType::class, $main);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($main);
            $entityManager->flush();

            return $this->redirectToRoute('main_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $main,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="main_show", methods={"GET"})
     */
    public function show(Main $main): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $main,
            'fields' => ['sn', 'date', 'dueDate', 'countChild' ,'countPiece', 'perWeight', 'totalWeight', 'upstreamDoc', 'model', 'stamp', 'size', 'note']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="main_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Main $main): Response
    {
        $form = $this->createForm(MainType::class, $main);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('main_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $main,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="main_delete", methods={"POST"})
     */
    public function delete(Request $request, Main $main): Response
    {
        if ($this->isCsrfTokenValid('delete'.$main->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($main);
            $entityManager->flush();
        }

        return $this->redirectToRoute('main_index');
    }
}
