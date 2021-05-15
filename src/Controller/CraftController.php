<?php

namespace App\Controller;

use App\Entity\Craft;
use App\Form\CraftType;
use App\Repository\CraftRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/craft")
 */
class CraftController extends AbstractController
{
    private $page = 'craft';

    /**
     * @Route("/", name="craft_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select c from App\Entity\Craft c order by c.id desc";
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

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $craft,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="craft_show", methods={"GET"})
     */
    public function show(Craft $craft): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $craft,
            'fields' => ['id', 'name']
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

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $craft,
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
