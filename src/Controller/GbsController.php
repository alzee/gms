<?php

namespace App\Controller;

use App\Entity\Gbs;
use App\Form\GbsType;
use App\Repository\GbsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gbs")
 */
class GbsController extends AbstractController
{
    /**
     * @Route("/", name="gbs_index", methods={"GET"})
     */
    public function index(GbsRepository $gbsRepository): Response
    {
        return $this->render('gbs/index.html.twig', [
            'gbs' => $gbsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="gbs_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $gb = new Gbs();
        $form = $this->createForm(GbsType::class, $gb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gb);
            $entityManager->flush();

            return $this->redirectToRoute('gbs_index');
        }

        return $this->render('gbs/new.html.twig', [
            'gb' => $gb,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gbs_show", methods={"GET"})
     */
    public function show(Gbs $gb): Response
    {
        return $this->render('gbs/show.html.twig', [
            'gb' => $gb,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="gbs_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Gbs $gb): Response
    {
        $form = $this->createForm(GbsType::class, $gb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gbs_index');
        }

        return $this->render('gbs/edit.html.twig', [
            'gb' => $gb,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gbs_delete", methods={"POST"})
     */
    public function delete(Request $request, Gbs $gb): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gb->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gb);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gbs_index');
    }
}
