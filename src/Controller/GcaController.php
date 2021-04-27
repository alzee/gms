<?php

namespace App\Controller;

use App\Entity\Gca;
use App\Form\GcaType;
use App\Repository\GcaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gca")
 */
class GcaController extends AbstractController
{
    /**
     * @Route("/", name="gca_index", methods={"GET"})
     */
    public function index(GcaRepository $gcaRepository): Response
    {
        return $this->render('gca/index.html.twig', [
            'gcas' => $gcaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="gca_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $gca = new Gca();
        $form = $this->createForm(GcaType::class, $gca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gca);
            $entityManager->flush();

            return $this->redirectToRoute('gca_index');
        }

        return $this->render('gca/new.html.twig', [
            'gca' => $gca,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gca_show", methods={"GET"})
     */
    public function show(Gca $gca): Response
    {
        return $this->render('gca/show.html.twig', [
            'gca' => $gca,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="gca_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Gca $gca): Response
    {
        $form = $this->createForm(GcaType::class, $gca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gca_index');
        }

        return $this->render('gca/edit.html.twig', [
            'gca' => $gca,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gca_delete", methods={"POST"})
     */
    public function delete(Request $request, Gca $gca): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gca->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gca);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gca_index');
    }
}