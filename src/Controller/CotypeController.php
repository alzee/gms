<?php

namespace App\Controller;

use App\Entity\Cotype;
use App\Form\CotypeType;
use App\Repository\CotypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/cotype")
 */
class CotypeController extends AbstractController
{

    /**
     * @Route("/new", name="cotype_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cotype = new Cotype();
        $form = $this->createForm(CotypeType::class, $cotype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cotype);
            $entityManager->flush();

            return $this->redirectToRoute('cotype_index');
        }

        return $this->render('cotype/new.html.twig', [
            'cotype' => $cotype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cotype_show", methods={"GET"})
     */
    public function show(Cotype $cotype): Response
    {
        return $this->render('cotype/show.html.twig', [
            'cotype' => $cotype,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cotype_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cotype $cotype): Response
    {
        $form = $this->createForm(CotypeType::class, $cotype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cotype_index');
        }

        return $this->render('cotype/edit.html.twig', [
            'cotype' => $cotype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cotype_delete", methods={"POST"})
     */
    public function delete(Request $request, Cotype $cotype): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cotype->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cotype);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cotype_index');
    }
}
