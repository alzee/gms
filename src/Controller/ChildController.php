<?php

namespace App\Controller;

use App\Entity\Child;
use App\Form\ChildType;
use App\Repository\ChildRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/child")
 */
class ChildController extends AbstractController
{
    private $page = 'child';

    /**
     * @Route("/", name="child_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select c from App\Entity\Child c order by c.id desc";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);
        $p = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('crud/index.html.twig', [
            'page' => $this->page,
            'items' => $p,
            'columns' => [
                ['name' => 'sn', 'sort' => 'c.sn'],
                ['name' => 'date', 'sort' => 'c.date'],
                ['name' => 'goldclass'],
                ['name' => 'note'],
                ['name' => 'countPiece'],
                ['name' => 'artisan'],
                ['name' => 'craft'],
                ['name' => 'weightGold'],
                ['name' => 'weightAttach'],
                ['name' => 'weight'],
                ['name' => 'box'],
                ['name' => 'size'],
                ['name' => 'model'],
            ]
        ]);
    }

    /**
     * @Route("/new", name="child_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $child = new Child();
        $form = $this->createForm(ChildType::class, $child);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($child);
            $entityManager->flush();

            return $this->redirectToRoute('child_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $child,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="child_show", methods={"GET"})
     */
    public function show(Child $child): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $child,
            'fields' => ['sn', 'date', 'goldclass', 'weightGold', 'weightAttach', 'weight', 'box', 'countPiece', 'artisan', 'craft', 'size', 'model']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="child_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Child $child): Response
    {
        $form = $this->createForm(ChildType::class, $child);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('child_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $child,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="child_delete", methods={"POST"})
     */
    public function delete(Request $request, Child $child): Response
    {
        if ($this->isCsrfTokenValid('delete'.$child->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($child);
            $entityManager->flush();
        }

        return $this->redirectToRoute('child_index');
    }
}
