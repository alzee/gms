<?php

namespace App\Controller;

use App\Entity\Process;
use App\Form\ProcessType;
use App\Repository\ProcessRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/process")
 */
class ProcessController extends AbstractController
{

    /**
     * @Route("/new", name="process_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $process = new Process();
        $form = $this->createForm(ProcessType::class, $process);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($process);
            $entityManager->flush();

            return $this->redirectToRoute('process_index');
        }

        return $this->render('process/new.html.twig', [
            'process' => $process,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="process_show", methods={"GET"})
     */
    public function show(Process $process): Response
    {
        return $this->render('process/show.html.twig', [
            'process' => $process,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="process_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Process $process): Response
    {
        $form = $this->createForm(ProcessType::class, $process);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('process_index');
        }

        return $this->render('process/edit.html.twig', [
            'process' => $process,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="process_delete", methods={"POST"})
     */
    public function delete(Request $request, Process $process): Response
    {
        if ($this->isCsrfTokenValid('delete'.$process->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($process);
            $entityManager->flush();
        }

        return $this->redirectToRoute('process_index');
    }
}
