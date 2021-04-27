<?php

namespace App\Controller;

use App\Entity\Gd;
use App\Form\GdType;
use App\Repository\GdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gd")
 */
class GdController extends AbstractController
{
    /**
     * @Route("/", name="gd_index", methods={"GET"})
     */
    public function index(GdRepository $gdRepository): Response
    {
        return $this->render('gd/index.html.twig', [
            'gds' => $gdRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="gd_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $gd = new Gd();
        $form = $this->createForm(GdType::class, $gd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gd);
            $entityManager->flush();

            return $this->redirectToRoute('gd_index');
        }

        return $this->render('gd/new.html.twig', [
            'gd' => $gd,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gd_show", methods={"GET"})
     */
    public function show(Gd $gd): Response
    {
        return $this->render('gd/show.html.twig', [
            'gd' => $gd,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="gd_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Gd $gd): Response
    {
        $form = $this->createForm(GdType::class, $gd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gd_index');
        }

        return $this->render('gd/edit.html.twig', [
            'gd' => $gd,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gd_delete", methods={"POST"})
     */
    public function delete(Request $request, Gd $gd): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gd->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gd);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gd_index');
    }
}
