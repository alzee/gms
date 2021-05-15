<?php

namespace App\Controller;

use App\Entity\Subtractreason;
use App\Form\SubtractreasonType;
use App\Repository\SubtractreasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/subtractreason")
 */
class SubtractreasonController extends AbstractController
{
    private $page = 'subtractreason';

    /**
     * @Route("/", name="subtractreason_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select s from App\Entity\Subtractreason s order by s.id desc";
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
     * @Route("/new", name="subtractreason_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $subtractreason = new Subtractreason();
        $form = $this->createForm(SubtractreasonType::class, $subtractreason);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subtractreason);
            $entityManager->flush();

            return $this->redirectToRoute('subtractreason_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $subtractreason,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subtractreason_show", methods={"GET"})
     */
    public function show(Subtractreason $subtractreason): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $subtractreason,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="subtractreason_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Subtractreason $subtractreason): Response
    {
        $form = $this->createForm(SubtractreasonType::class, $subtractreason);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subtractreason_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $subtractreason,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subtractreason_delete", methods={"POST"})
     */
    public function delete(Request $request, Subtractreason $subtractreason): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subtractreason->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($subtractreason);
            $entityManager->flush();
        }

        return $this->redirectToRoute('subtractreason_index');
    }
}
