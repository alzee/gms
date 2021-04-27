<?php

namespace App\Controller;

use App\Entity\Ac;
use App\Form\AcType;
use App\Repository\AcRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ac")
 */
class AcController extends AbstractController
{
    /**
     * @Route("/", name="ac_index", methods={"GET"})
     */
    public function index(AcRepository $acRepository): Response
    {
        return $this->render('ac/index.html.twig', [
            'acs' => $acRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ac_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ac = new Ac();
        $form = $this->createForm(AcType::class, $ac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ac);
            $entityManager->flush();

            return $this->redirectToRoute('ac_index');
        }

        return $this->render('ac/new.html.twig', [
            'ac' => $ac,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ac_show", methods={"GET"})
     */
    public function show(Ac $ac): Response
    {
        return $this->render('ac/show.html.twig', [
            'ac' => $ac,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ac_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ac $ac): Response
    {
        $form = $this->createForm(AcType::class, $ac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ac_index');
        }

        return $this->render('ac/edit.html.twig', [
            'ac' => $ac,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ac_delete", methods={"POST"})
     */
    public function delete(Request $request, Ac $ac): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ac->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ac);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ac_index');
    }
}
