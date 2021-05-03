<?php

namespace App\Controller;

use App\Entity\Subtracttype;
use App\Form\SubtracttypeType;
use App\Repository\SubtracttypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/subtracttype")
 */
class SubtracttypeController extends AbstractController
{
    /**
     * @Route("/", name="subtracttype_index", methods={"GET"})
     */
    public function index(SubtracttypeRepository $subtracttypeRepository): Response
    {
        return $this->render('subtracttype/index.html.twig', [
            'subtracttypes' => $subtracttypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="subtracttype_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $subtracttype = new Subtracttype();
        $form = $this->createForm(SubtracttypeType::class, $subtracttype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subtracttype);
            $entityManager->flush();

            return $this->redirectToRoute('subtracttype_index');
        }

        return $this->render('subtracttype/new.html.twig', [
            'subtracttype' => $subtracttype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subtracttype_show", methods={"GET"})
     */
    public function show(Subtracttype $subtracttype): Response
    {
        return $this->render('subtracttype/show.html.twig', [
            'subtracttype' => $subtracttype,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="subtracttype_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Subtracttype $subtracttype): Response
    {
        $form = $this->createForm(SubtracttypeType::class, $subtracttype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subtracttype_index');
        }

        return $this->render('subtracttype/edit.html.twig', [
            'subtracttype' => $subtracttype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subtracttype_delete", methods={"POST"})
     */
    public function delete(Request $request, Subtracttype $subtracttype): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subtracttype->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($subtracttype);
            $entityManager->flush();
        }

        return $this->redirectToRoute('subtracttype_index');
    }
}
