<?php

namespace App\Controller;

use App\Entity\Addtype;
use App\Form\AddtypeType;
use App\Repository\AddtypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/addtype")
 */
class AddtypeController extends AbstractController
{
    /**
     * @Route("/", name="addtype_index", methods={"GET"})
     */
    public function index(AddtypeRepository $addtypeRepository): Response
    {
        return $this->render('addtype/index.html.twig', [
            'addtypes' => $addtypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="addtype_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $addtype = new Addtype();
        $form = $this->createForm(AddtypeType::class, $addtype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($addtype);
            $entityManager->flush();

            return $this->redirectToRoute('addtype_index');
        }

        return $this->render('addtype/new.html.twig', [
            'addtype' => $addtype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="addtype_show", methods={"GET"})
     */
    public function show(Addtype $addtype): Response
    {
        return $this->render('addtype/show.html.twig', [
            'addtype' => $addtype,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="addtype_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Addtype $addtype): Response
    {
        $form = $this->createForm(AddtypeType::class, $addtype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('addtype_index');
        }

        return $this->render('addtype/edit.html.twig', [
            'addtype' => $addtype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="addtype_delete", methods={"POST"})
     */
    public function delete(Request $request, Addtype $addtype): Response
    {
        if ($this->isCsrfTokenValid('delete'.$addtype->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($addtype);
            $entityManager->flush();
        }

        return $this->redirectToRoute('addtype_index');
    }
}
