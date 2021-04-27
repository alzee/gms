<?php

namespace App\Controller;

use App\Entity\Craft;
use App\Form\CraftType;
use App\Repository\CraftRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/craft")
 */
class CraftController extends AbstractController
{
    /**
     * @Route("/", name="craft_index", methods={"GET"})
     */
    public function index(CraftRepository $craftRepository): Response
    {
        return $this->render('craft/index.html.twig', [
            'crafts' => $craftRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="craft_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $craft = new Craft();
        $form = $this->createForm(CraftType::class, $craft);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($craft);
            $entityManager->flush();

            return $this->redirectToRoute('craft_index');
        }

        return $this->render('craft/new.html.twig', [
            'craft' => $craft,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="craft_show", methods={"GET"})
     */
    public function show(Craft $craft): Response
    {
        return $this->render('craft/show.html.twig', [
            'craft' => $craft,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="craft_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Craft $craft): Response
    {
        $form = $this->createForm(CraftType::class, $craft);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('craft_index');
        }

        return $this->render('craft/edit.html.twig', [
            'craft' => $craft,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="craft_delete", methods={"POST"})
     */
    public function delete(Request $request, Craft $craft): Response
    {
        if ($this->isCsrfTokenValid('delete'.$craft->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($craft);
            $entityManager->flush();
        }

        return $this->redirectToRoute('craft_index');
    }
}
