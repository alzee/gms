<?php

namespace App\Controller;

use App\Entity\Doctype;
use App\Form\DoctypeType;
use App\Repository\DoctypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/doctype")
 */
class DoctypeController extends AbstractController
{
    private $page = 'doctype';

    /**
     * @Route("/", name="doctype_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select d from App\Entity\Doctype d order by d.id desc";
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
     * @Route("/new", name="doctype_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $doctype = new Doctype();
        $form = $this->createForm(DoctypeType::class, $doctype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($doctype);
            $entityManager->flush();

            return $this->redirectToRoute('doctype_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $doctype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="doctype_show", methods={"GET"})
     */
    public function show(Doctype $doctype): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $doctype,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="doctype_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Doctype $doctype): Response
    {
        $form = $this->createForm(DoctypeType::class, $doctype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('doctype_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $doctype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="doctype_delete", methods={"POST"})
     */
    public function delete(Request $request, Doctype $doctype): Response
    {
        if ($this->isCsrfTokenValid('delete'.$doctype->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($doctype);
            $entityManager->flush();
        }

        return $this->redirectToRoute('doctype_index');
    }
}
