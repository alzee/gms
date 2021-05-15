<?php

namespace App\Controller;

use App\Entity\Lossrate;
use App\Form\LossrateType;
use App\Repository\LossrateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lossrate")
 */
class LossrateController extends AbstractController
{
    /**
     * @Route("/", name="lossrate_index", methods={"GET"})
     */
    public function index(LossrateRepository $lossrateRepository): Response
    {
        return $this->render('lossrate/index.html.twig', [
            'lossrates' => $lossrateRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="lossrate_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lossrate = new Lossrate();
        $form = $this->createForm(LossrateType::class, $lossrate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lossrate);
            $entityManager->flush();

            return $this->redirectToRoute('lossrate_index');
        }

        return $this->render('lossrate/new.html.twig', [
            'lossrate' => $lossrate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lossrate_show", methods={"GET"})
     */
    public function show(Lossrate $lossrate): Response
    {
        return $this->render('lossrate/show.html.twig', [
            'lossrate' => $lossrate,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lossrate_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Lossrate $lossrate): Response
    {
        $form = $this->createForm(LossrateType::class, $lossrate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lossrate_index');
        }

        return $this->render('lossrate/edit.html.twig', [
            'lossrate' => $lossrate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lossrate_delete", methods={"POST"})
     */
    public function delete(Request $request, Lossrate $lossrate): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lossrate->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lossrate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lossrate_index');
    }
}
