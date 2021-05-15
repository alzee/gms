<?php

namespace App\Controller;

use App\Entity\Subtractreason;
use App\Form\SubtractreasonType;
use App\Repository\SubtractreasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/subtractreason")
 */
class SubtractreasonController extends AbstractController
{

    /**
     * @Route("/new", name="subtractreason_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $subtractreason = new Subtractreason();
        $form = $this->createForm(SubtractreasonType::class, $subtractreason);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subtractreason);
            $entityManager->flush();

            return $this->redirectToRoute('subtractreason_index');
        }

        return $this->render('subtractreason/new.html.twig', [
            'subtractreason' => $subtractreason,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subtractreason_show", methods={"GET"})
     */
    public function show(Subtractreason $subtractreason): Response
    {
        return $this->render('subtractreason/show.html.twig', [
            'subtractreason' => $subtractreason,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="subtractreason_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Subtractreason $subtractreason): Response
    {
        $form = $this->createForm(SubtractreasonType::class, $subtractreason);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subtractreason_index');
        }

        return $this->render('subtractreason/edit.html.twig', [
            'subtractreason' => $subtractreason,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subtractreason_delete", methods={"POST"})
     */
    public function delete(Request $request, Subtractreason $subtractreason): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subtractreason->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($subtractreason);
            $entityManager->flush();
        }

        return $this->redirectToRoute('subtractreason_index');
    }
}
