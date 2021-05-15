<?php

namespace App\Controller;

use App\Entity\Subtracttype;
use App\Form\SubtracttypeType;
use App\Repository\SubtracttypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/subtracttype")
 */
class SubtracttypeController extends AbstractController
{
    private $page = 'subtracttype';

    /**
     * @Route("/", name="subtracttype_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select s from App\Entity\Subtracttype s order by s.id desc";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);
        $p = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('crud/index.html.twig', [
            'page' => $this->page,
            'items' => $p,
            'columns' => [
                ['name' => 'id'],
                ['name' => 'name']
            ]
        ]);
    }

    /**
     * @Route("/new", name="subtracttype_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $subtracttype = new Subtracttype();
        $form = $this->createForm(SubtracttypeType::class, $subtracttype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subtracttype);
            $entityManager->flush();

            return $this->redirectToRoute('subtracttype_index');
        }

        return $this->render('subtracttype/new.html.twig', [
            'page' => $this->page,
            'item' => $subtracttype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subtracttype_show", methods={"GET"})
     */
    public function show(Subtracttype $subtracttype): Response
    {
        return $this->render('subtracttype/show.html.twig', [
            'page' => $this->page,
            'item' => $subtracttype,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="subtracttype_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Subtracttype $subtracttype): Response
    {
        $form = $this->createForm(SubtracttypeType::class, $subtracttype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subtracttype_index');
        }

        return $this->render('subtracttype/edit.html.twig', [
            'page' => $this->page,
            'item' => $subtracttype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subtracttype_delete", methods={"POST"})
     */
    public function delete(Request $request, Subtracttype $subtracttype): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subtracttype->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($subtracttype);
            $entityManager->flush();
        }

        return $this->redirectToRoute('subtracttype_index');
    }
}
