<?php

namespace App\Controller;

use App\Entity\Embed;
use App\Form\EmbedType;
use App\Repository\EmbedRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/embed")
 */
class EmbedController extends AbstractController
{
    private $page = 'embed';

    /**
     * @Route("/", name="embed_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select e from App\Entity\Embed e order by e.id desc";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);
        $p = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('crud/index.html.twig', [
            'page' => $this->page,
            'items' => $p,
            'columns' => [
                ['name' => 'id'],
                ['name' => 'name']
            ]
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

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $embed,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="embed_show", methods={"GET"})
     */
    public function show(Embed $embed): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $embed,
            'fields' => ['id', 'name']
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

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $embed,
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
