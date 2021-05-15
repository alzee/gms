<?php

namespace App\Controller;

use App\Entity\Granule;
use App\Form\GranuleType;
use App\Repository\GranuleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/granule")
 */
class GranuleController extends AbstractController
{

    /**
     * @Route("/new", name="granule_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $granule = new Granule();
        $form = $this->createForm(GranuleType::class, $granule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($granule);
            $entityManager->flush();

            return $this->redirectToRoute('granule_index');
        }

        return $this->render('granule/new.html.twig', [
            'granule' => $granule,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="granule_show", methods={"GET"})
     */
    public function show(Granule $granule): Response
    {
        return $this->render('granule/show.html.twig', [
            'granule' => $granule,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="granule_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Granule $granule): Response
    {
        $form = $this->createForm(GranuleType::class, $granule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('granule_index');
        }

        return $this->render('granule/edit.html.twig', [
            'granule' => $granule,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="granule_delete", methods={"POST"})
     */
    public function delete(Request $request, Granule $granule): Response
    {
        if ($this->isCsrfTokenValid('delete'.$granule->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($granule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('granule_index');
    }
}
