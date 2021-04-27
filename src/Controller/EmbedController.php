<?php

namespace App\Controller;

use App\Entity\Embed;
use App\Form\EmbedType;
use App\Repository\EmbedRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/embed")
 */
class EmbedController extends AbstractController
{
    /**
     * @Route("/", name="embed_index", methods={"GET"})
     */
    public function index(EmbedRepository $embedRepository): Response
    {
        return $this->render('embed/index.html.twig', [
            'embeds' => $embedRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="embed_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $embed = new Embed();
        $form = $this->createForm(EmbedType::class, $embed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($embed);
            $entityManager->flush();

            return $this->redirectToRoute('embed_index');
        }

        return $this->render('embed/new.html.twig', [
            'embed' => $embed,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="embed_show", methods={"GET"})
     */
    public function show(Embed $embed): Response
    {
        return $this->render('embed/show.html.twig', [
            'embed' => $embed,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="embed_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Embed $embed): Response
    {
        $form = $this->createForm(EmbedType::class, $embed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('embed_index');
        }

        return $this->render('embed/edit.html.twig', [
            'embed' => $embed,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="embed_delete", methods={"POST"})
     */
    public function delete(Request $request, Embed $embed): Response
    {
        if ($this->isCsrfTokenValid('delete'.$embed->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($embed);
            $entityManager->flush();
        }

        return $this->redirectToRoute('embed_index');
    }
}
