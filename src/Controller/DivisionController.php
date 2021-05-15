<?php

namespace App\Controller;

use App\Entity\Division;
use App\Form\DivisionType;
use App\Repository\DivisionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/division")
 */
class DivisionController extends AbstractController
{
    private $page = 'division';

    /**
     * @Route("/", name="division_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select d from App\Entity\Division d order by d.id desc";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);
        $p = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('crud/index.html.twig', [
            'page' => $this->page,
            'items' => $p,
            'columns' => [
                ['name' => 'id'],
                ['name' => 'name'],
            ]
        ]);
    }

    /**
     * @Route("/new", name="division_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $division = new Division();
        $form = $this->createForm(DivisionType::class, $division);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($division);
            $entityManager->flush();

            return $this->redirectToRoute('division_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $division,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="division_show", methods={"GET"})
     */
    public function show(Division $division): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $division,
            'fields' => ['id', 'name'],
        ]);
    }

    /**
     * @Route("/{id}/edit", name="division_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Division $division): Response
    {
        $form = $this->createForm(DivisionType::class, $division);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('division_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $division,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="division_delete", methods={"POST"})
     */
    public function delete(Request $request, Division $division): Response
    {
        if ($this->isCsrfTokenValid('delete'.$division->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($division);
            $entityManager->flush();
        }

        return $this->redirectToRoute('division_index');
    }
}
