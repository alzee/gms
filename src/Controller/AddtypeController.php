<?php

namespace App\Controller;

use App\Entity\Addtype;
use App\Form\AddtypeType;
use App\Repository\AddtypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/addtype")
 */
class AddtypeController extends AbstractController
{
    private $page = 'addtype';

    /**
     * @Route("/", name="addtype_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select a from App\Entity\Addtype a order by a.id desc";
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
     * @Route("/new", name="addtype_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $addtype = new Addtype();
        $form = $this->createForm(AddtypeType::class, $addtype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($addtype);
            $entityManager->flush();

            return $this->redirectToRoute('addtype_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $addtype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="addtype_show", methods={"GET"})
     */
    public function show(Addtype $addtype): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $addtype,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="addtype_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Addtype $addtype): Response
    {
        $form = $this->createForm(AddtypeType::class, $addtype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('addtype_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $addtype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="addtype_delete", methods={"POST"})
     */
    public function delete(Request $request, Addtype $addtype): Response
    {
        if ($this->isCsrfTokenValid('delete'.$addtype->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($addtype);
            $entityManager->flush();
        }

        return $this->redirectToRoute('addtype_index');
    }
}
