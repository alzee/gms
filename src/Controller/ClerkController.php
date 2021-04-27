<?php

namespace App\Controller;

use App\Entity\Clerk;
use App\Form\ClerkType;
use App\Repository\ClerkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/clerk")
 */
class ClerkController extends AbstractController
{
    /**
     * @Route("/", name="clerk_index", methods={"GET"})
     */
    public function index(ClerkRepository $clerkRepository): Response
    {
        return $this->render('clerk/index.html.twig', [
            'clerks' => $clerkRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="clerk_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $clerk = new Clerk();
        $form = $this->createForm(ClerkType::class, $clerk);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($clerk);
            $entityManager->flush();

            return $this->redirectToRoute('clerk_index');
        }

        return $this->render('clerk/new.html.twig', [
            'clerk' => $clerk,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="clerk_show", methods={"GET"})
     */
    public function show(Clerk $clerk): Response
    {
        return $this->render('clerk/show.html.twig', [
            'clerk' => $clerk,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="clerk_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Clerk $clerk): Response
    {
        $form = $this->createForm(ClerkType::class, $clerk);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('clerk_index');
        }

        return $this->render('clerk/edit.html.twig', [
            'clerk' => $clerk,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="clerk_delete", methods={"POST"})
     */
    public function delete(Request $request, Clerk $clerk): Response
    {
        if ($this->isCsrfTokenValid('delete'.$clerk->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($clerk);
            $entityManager->flush();
        }

        return $this->redirectToRoute('clerk_index');
    }
}
