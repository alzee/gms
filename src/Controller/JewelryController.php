<?php

namespace App\Controller;

use App\Entity\Jewelry;
use App\Form\JewelryType;
use App\Repository\JewelryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/jewelry")
 */
class JewelryController extends AbstractController
{
    private $page = 'jewelry';

    /**
     * @Route("/", name="jewelry_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select j from App\Entity\Jewelry j order by j.id desc";
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
     * @Route("/new", name="jewelry_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $jewelry = new Jewelry();
        $form = $this->createForm(JewelryType::class, $jewelry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($jewelry);
            $entityManager->flush();

            return $this->redirectToRoute('jewelry_index');
        }

        return $this->render('jewelry/new.html.twig', [
            'page' => $this->page,
            'item' => $jewelry,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="jewelry_show", methods={"GET"})
     */
    public function show(Jewelry $jewelry): Response
    {
        return $this->render('jewelry/show.html.twig', [
            'page' => $this->page,
            'item' => $jewelry,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="jewelry_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Jewelry $jewelry): Response
    {
        $form = $this->createForm(JewelryType::class, $jewelry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jewelry_index');
        }

        return $this->render('jewelry/edit.html.twig', [
            'page' => $this->page,
            'item' => $jewelry,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="jewelry_delete", methods={"POST"})
     */
    public function delete(Request $request, Jewelry $jewelry): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jewelry->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($jewelry);
            $entityManager->flush();
        }

        return $this->redirectToRoute('jewelry_index');
    }
}
