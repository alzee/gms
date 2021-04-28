<?php

namespace App\Controller;

use App\Entity\Ca;
use App\Form\CaType;
use App\Repository\CaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ca")
 */
class CaController extends AbstractController
{
    /**
     * @Route("/", name="ca_index", methods={"GET"})
     */
    public function index(CaRepository $caRepository): Response
    {
        return $this->render('ca/index.html.twig', [
            'cas' => $caRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ca_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ca = new Ca();
        $ca->setDate(new \DateTimeImmutable());
        $form = $this->createForm(CaType::class, $ca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ca);
            $entityManager->flush();

            return $this->redirectToRoute('ca_index');
        }

        return $this->render('ca/new.html.twig', [
            'ca' => $ca,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ca_show", methods={"GET"})
     */
    public function show(Ca $ca): Response
    {
        return $this->render('ca/show.html.twig', [
            'ca' => $ca,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ca_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ca $ca): Response
    {
        $form = $this->createForm(CaType::class, $ca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ca_index');
        }

        return $this->render('ca/edit.html.twig', [
            'ca' => $ca,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ca_delete", methods={"POST"})
     */
    public function delete(Request $request, Ca $ca): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ca->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ca);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ca_index');
    }
}
