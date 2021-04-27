<?php

namespace App\Controller;

use App\Entity\Seq;
use App\Form\SeqType;
use App\Repository\SeqRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/seq")
 */
class SeqController extends AbstractController
{
    /**
     * @Route("/", name="seq_index", methods={"GET"})
     */
    public function index(SeqRepository $seqRepository): Response
    {
        return $this->render('seq/index.html.twig', [
            'seqs' => $seqRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="seq_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $seq = new Seq();
        $form = $this->createForm(SeqType::class, $seq);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($seq);
            $entityManager->flush();

            return $this->redirectToRoute('seq_index');
        }

        return $this->render('seq/new.html.twig', [
            'seq' => $seq,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="seq_show", methods={"GET"})
     */
    public function show(Seq $seq): Response
    {
        return $this->render('seq/show.html.twig', [
            'seq' => $seq,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="seq_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Seq $seq): Response
    {
        $form = $this->createForm(SeqType::class, $seq);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seq_index');
        }

        return $this->render('seq/edit.html.twig', [
            'seq' => $seq,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="seq_delete", methods={"POST"})
     */
    public function delete(Request $request, Seq $seq): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seq->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($seq);
            $entityManager->flush();
        }

        return $this->redirectToRoute('seq_index');
    }
}
