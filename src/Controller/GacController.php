<?php

namespace App\Controller;

use App\Entity\Gac;
use App\Form\GacType;
use App\Repository\GacRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gac")
 */
class GacController extends AbstractController
{
    /**
     * @Route("/", name="gac_index", methods={"GET"})
     */
    public function index(GacRepository $gacRepository): Response
    {
        return $this->render('gac/index.html.twig', [
            'gacs' => $gacRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="gac_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $gac = new Gac();
        $form = $this->createForm(GacType::class, $gac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gac);
            $entityManager->flush();

            return $this->redirectToRoute('gac_index');
        }

        return $this->render('gac/new.html.twig', [
            'gac' => $gac,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gac_show", methods={"GET"})
     */
    public function show(Gac $gac): Response
    {
        return $this->render('gac/show.html.twig', [
            'gac' => $gac,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="gac_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Gac $gac): Response
    {
        $form = $this->createForm(GacType::class, $gac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gac_index');
        }

        return $this->render('gac/edit.html.twig', [
            'gac' => $gac,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gac_delete", methods={"POST"})
     */
    public function delete(Request $request, Gac $gac): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gac->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gac);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gac_index');
    }
}
