<?php

namespace App\Controller;

use App\Entity\Wage;
use App\Form\WageType;
use App\Repository\WageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/wage")
 */
class WageController extends AbstractController
{
    private $page = 'wage';

    /**
     * @Route("/", name="wage_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select w from App\Entity\Wage w order by w.id desc";
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
     * @Route("/new", name="wage_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $wage = new Wage();
        $form = $this->createForm(WageType::class, $wage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($wage);
            $entityManager->flush();

            return $this->redirectToRoute('wage_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $wage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="wage_show", methods={"GET"})
     */
    public function show(Wage $wage): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $wage,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="wage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Wage $wage): Response
    {
        $form = $this->createForm(WageType::class, $wage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('wage_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $wage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="wage_delete", methods={"POST"})
     */
    public function delete(Request $request, Wage $wage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$wage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($wage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('wage_index');
    }
}
