<?php

namespace App\Controller;

use App\Entity\Jewelry;
use App\Form\JewelryType;
use App\Repository\JewelryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/jewelry")
 */
class JewelryController extends AbstractController
{

    /**
     * @Route("/new", name="jewelry_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $jewelry = new Jewelry();
        $form = $this->createForm(JewelryType::class, $jewelry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($jewelry);
            $entityManager->flush();

            return $this->redirectToRoute('jewelry_index');
        }

        return $this->render('jewelry/new.html.twig', [
            'jewelry' => $jewelry,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="jewelry_show", methods={"GET"})
     */
    public function show(Jewelry $jewelry): Response
    {
        return $this->render('jewelry/show.html.twig', [
            'jewelry' => $jewelry,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="jewelry_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Jewelry $jewelry): Response
    {
        $form = $this->createForm(JewelryType::class, $jewelry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jewelry_index');
        }

        return $this->render('jewelry/edit.html.twig', [
            'jewelry' => $jewelry,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="jewelry_delete", methods={"POST"})
     */
    public function delete(Request $request, Jewelry $jewelry): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jewelry->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($jewelry);
            $entityManager->flush();
        }

        return $this->redirectToRoute('jewelry_index');
    }
}
