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
            'prodtype' => $prodtype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prodtype_show", methods={"GET"})
     */
    public function show(Prodtype $prodtype): Response
    {
        return $this->render('prodtype/show.html.twig', [
            'prodtype' => $prodtype,
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
            'prodtype' => $prodtype,
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
