<?php

namespace App\Controller;

use App\Entity\Attach;
use App\Form\AttachType;
use App\Repository\AttachRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/attach")
 */
class AttachController extends AbstractController
{
    /**
     * @Route("/", name="attach_index", methods={"GET"})
     */
    public function index(AttachRepository $attachRepository): Response
    {
        return $this->render('attach/index.html.twig', [
            'attaches' => $attachRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="attach_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $attach = new Attach();
        $form = $this->createForm(AttachType::class, $attach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($attach);
            $entityManager->flush();

            return $this->redirectToRoute('attach_index');
        }

        return $this->render('attach/new.html.twig', [
            'attach' => $attach,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="attach_show", methods={"GET"})
     */
    public function show(Attach $attach): Response
    {
        return $this->render('attach/show.html.twig', [
            'attach' => $attach,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="attach_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Attach $attach): Response
    {
        $form = $this->createForm(AttachType::class, $attach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('attach_index');
        }

        return $this->render('attach/edit.html.twig', [
            'attach' => $attach,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="attach_delete", methods={"POST"})
     */
    public function delete(Request $request, Attach $attach): Response
    {
        if ($this->isCsrfTokenValid('delete'.$attach->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($attach);
            $entityManager->flush();
        }

        return $this->redirectToRoute('attach_index');
    }
}
