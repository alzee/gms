<?php

namespace App\Controller;

use App\Entity\Own;
use App\Form\OwnType;
use App\Repository\OwnRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/own")
 */
class OwnController extends AbstractController
{
    private $page = 'own';

    /**
     * @Route("/", name="own_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select o from App\Entity\Own o order by o.id desc";
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
     * @Route("/new", name="own_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $own = new Own();
        $form = $this->createForm(OwnType::class, $own);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($own);
            $entityManager->flush();

            return $this->redirectToRoute('own_index');
        }

        return $this->render('own/new.html.twig', [
            'page' => $this->page,
            'item' => $own,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="own_show", methods={"GET"})
     */
    public function show(Own $own): Response
    {
        return $this->render('own/show.html.twig', [
            'page' => $this->page,
            'item' => $own,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="own_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Own $own): Response
    {
        $form = $this->createForm(OwnType::class, $own);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('own_index');
        }

        return $this->render('own/edit.html.twig', [
            'page' => $this->page,
            'item' => $own,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="own_delete", methods={"POST"})
     */
    public function delete(Request $request, Own $own): Response
    {
        if ($this->isCsrfTokenValid('delete'.$own->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($own);
            $entityManager->flush();
        }

        return $this->redirectToRoute('own_index');
    }
}
