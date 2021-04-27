<?php

namespace App\Controller;

use App\Entity\Doctype;
use App\Form\DoctypeType;
use App\Repository\DoctypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/doctype")
 */
class DoctypeController extends AbstractController
{
    /**
     * @Route("/", name="doctype_index", methods={"GET"})
     */
    public function index(DoctypeRepository $doctypeRepository): Response
    {
        return $this->render('doctype/index.html.twig', [
            'doctypes' => $doctypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="doctype_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $doctype = new Doctype();
        $form = $this->createForm(DoctypeType::class, $doctype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($doctype);
            $entityManager->flush();

            return $this->redirectToRoute('doctype_index');
        }

        return $this->render('doctype/new.html.twig', [
            'doctype' => $doctype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="doctype_show", methods={"GET"})
     */
    public function show(Doctype $doctype): Response
    {
        return $this->render('doctype/show.html.twig', [
            'doctype' => $doctype,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="doctype_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Doctype $doctype): Response
    {
        $form = $this->createForm(DoctypeType::class, $doctype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('doctype_index');
        }

        return $this->render('doctype/edit.html.twig', [
            'doctype' => $doctype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="doctype_delete", methods={"POST"})
     */
    public function delete(Request $request, Doctype $doctype): Response
    {
        if ($this->isCsrfTokenValid('delete'.$doctype->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($doctype);
            $entityManager->flush();
        }

        return $this->redirectToRoute('doctype_index');
    }
}
