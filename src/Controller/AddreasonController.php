<?php

namespace App\Controller;

use App\Entity\Addreason;
use App\Form\AddreasonType;
use App\Repository\AddreasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/addreason")
 */
class AddreasonController extends AbstractController
{
    /**
     * @Route("/", name="addreason_index", methods={"GET"})
     */
    public function index(AddreasonRepository $addreasonRepository): Response
    {
        return $this->render('addreason/index.html.twig', [
            'addreasons' => $addreasonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="addreason_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $addreason = new Addreason();
        $form = $this->createForm(AddreasonType::class, $addreason);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($addreason);
            $entityManager->flush();

            return $this->redirectToRoute('addreason_index');
        }

        return $this->render('addreason/new.html.twig', [
            'addreason' => $addreason,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="addreason_show", methods={"GET"})
     */
    public function show(Addreason $addreason): Response
    {
        return $this->render('addreason/show.html.twig', [
            'addreason' => $addreason,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="addreason_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Addreason $addreason): Response
    {
        $form = $this->createForm(AddreasonType::class, $addreason);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('addreason_index');
        }

        return $this->render('addreason/edit.html.twig', [
            'addreason' => $addreason,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="addreason_delete", methods={"POST"})
     */
    public function delete(Request $request, Addreason $addreason): Response
    {
        if ($this->isCsrfTokenValid('delete'.$addreason->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($addreason);
            $entityManager->flush();
        }

        return $this->redirectToRoute('addreason_index');
    }
}
