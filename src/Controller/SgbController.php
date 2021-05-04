<?php

namespace App\Controller;

use App\Entity\Sgb;
use App\Form\SgbType;
use App\Repository\SgbRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sgb")
 */
class SgbController extends AbstractController
{
    /**
     * @Route("/", name="sgb_index", methods={"GET"})
     */
    public function index(SgbRepository $sgbRepository): Response
    {
        return $this->render('sgb/index.html.twig', [
            'sgbs' => $sgbRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sgb_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sgb = new Sgb();
        $form = $this->createForm(SgbType::class, $sgb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sgb);
            $entityManager->flush();

            return $this->redirectToRoute('sgb_index');
        }

        return $this->render('sgb/new.html.twig', [
            'sgb' => $sgb,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sgb_show", methods={"GET"})
     */
    public function show(Sgb $sgb): Response
    {
        return $this->render('sgb/show.html.twig', [
            'sgb' => $sgb,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sgb_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sgb $sgb): Response
    {
        $form = $this->createForm(SgbType::class, $sgb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sgb_index');
        }

        return $this->render('sgb/edit.html.twig', [
            'sgb' => $sgb,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sgb_delete", methods={"POST"})
     */
    public function delete(Request $request, Sgb $sgb): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sgb->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sgb);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sgb_index');
    }
}
