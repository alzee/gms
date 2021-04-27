<?php

namespace App\Controller;

use App\Entity\Goldclass;
use App\Form\GoldclassType;
use App\Repository\GoldclassRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/goldclass")
 */
class GoldclassController extends AbstractController
{
    /**
     * @Route("/", name="goldclass_index", methods={"GET"})
     */
    public function index(GoldclassRepository $goldclassRepository): Response
    {
        return $this->render('goldclass/index.html.twig', [
            'goldclasses' => $goldclassRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="goldclass_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $goldclass = new Goldclass();
        $form = $this->createForm(GoldclassType::class, $goldclass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($goldclass);
            $entityManager->flush();

            return $this->redirectToRoute('goldclass_index');
        }

        return $this->render('goldclass/new.html.twig', [
            'goldclass' => $goldclass,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="goldclass_show", methods={"GET"})
     */
    public function show(Goldclass $goldclass): Response
    {
        return $this->render('goldclass/show.html.twig', [
            'goldclass' => $goldclass,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="goldclass_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Goldclass $goldclass): Response
    {
        $form = $this->createForm(GoldclassType::class, $goldclass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('goldclass_index');
        }

        return $this->render('goldclass/edit.html.twig', [
            'goldclass' => $goldclass,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="goldclass_delete", methods={"POST"})
     */
    public function delete(Request $request, Goldclass $goldclass): Response
    {
        if ($this->isCsrfTokenValid('delete'.$goldclass->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($goldclass);
            $entityManager->flush();
        }

        return $this->redirectToRoute('goldclass_index');
    }
}
