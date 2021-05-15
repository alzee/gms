<?php

namespace App\Controller;

use App\Entity\Prodtype;
use App\Form\ProdtypeType;
use App\Repository\ProdtypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/prodtype")
 */
class ProdtypeController extends AbstractController
{
    private $page = 'prodtype';

    /**
     * @Route("/", name="prodtype_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select p from App\Entity\Prodtype p order by p.id desc";
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
     * @Route("/new", name="prodtype_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $prodtype = new Prodtype();
        $form = $this->createForm(ProdtypeType::class, $prodtype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prodtype);
            $entityManager->flush();

            return $this->redirectToRoute('prodtype_index');
        }

        return $this->render('prodtype/new.html.twig', [
            'page' => $this->page,
            'item' => $prodtype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prodtype_show", methods={"GET"})
     */
    public function show(Prodtype $prodtype): Response
    {
        return $this->render('prodtype/show.html.twig', [
            'page' => $this->page,
            'item' => $prodtype,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="prodtype_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Prodtype $prodtype): Response
    {
        $form = $this->createForm(ProdtypeType::class, $prodtype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prodtype_index');
        }

        return $this->render('prodtype/edit.html.twig', [
            'page' => $this->page,
            'item' => $prodtype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prodtype_delete", methods={"POST"})
     */
    public function delete(Request $request, Prodtype $prodtype): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prodtype->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($prodtype);
            $entityManager->flush();
        }

        return $this->redirectToRoute('prodtype_index');
    }
}
