<?php

namespace App\Controller;

use App\Entity\Op;
use App\Form\OpType;
use App\Repository\OpRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/op")
 */
class OpController extends AbstractController
{

    /**
     * @Route("/new", name="op_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $op = new Op();
        $form = $this->createForm(OpType::class, $op);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($op);
            $entityManager->flush();

            return $this->redirectToRoute('op_index');
        }

        return $this->render('op/new.html.twig', [
            'op' => $op,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="op_show", methods={"GET"})
     */
    public function show(Op $op): Response
    {
        return $this->render('op/show.html.twig', [
            'op' => $op,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="op_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Op $op): Response
    {
        $form = $this->createForm(OpType::class, $op);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('op_index');
        }

        return $this->render('op/edit.html.twig', [
            'op' => $op,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="op_delete", methods={"POST"})
     */
    public function delete(Request $request, Op $op): Response
    {
        if ($this->isCsrfTokenValid('delete'.$op->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($op);
            $entityManager->flush();
        }

        return $this->redirectToRoute('op_index');
    }
}
