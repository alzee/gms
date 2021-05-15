<?php

namespace App\Controller;

use App\Entity\Own;
use App\Form\OwnType;
use App\Repository\OwnRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/own")
 */
class OwnController extends AbstractController
{

    /**
     * @Route("/new", name="own_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $own = new Own();
        $form = $this->createForm(OwnType::class, $own);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($own);
            $entityManager->flush();

            return $this->redirectToRoute('own_index');
        }

        return $this->render('own/new.html.twig', [
            'own' => $own,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="own_show", methods={"GET"})
     */
    public function show(Own $own): Response
    {
        return $this->render('own/show.html.twig', [
            'own' => $own,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="own_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Own $own): Response
    {
        $form = $this->createForm(OwnType::class, $own);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('own_index');
        }

        return $this->render('own/edit.html.twig', [
            'own' => $own,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="own_delete", methods={"POST"})
     */
    public function delete(Request $request, Own $own): Response
    {
        if ($this->isCsrfTokenValid('delete'.$own->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($own);
            $entityManager->flush();
        }

        return $this->redirectToRoute('own_index');
    }
}
