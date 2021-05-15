<?php

namespace App\Controller;

use App\Entity\Branch;
use App\Form\BranchType;
use App\Repository\BranchRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/branch")
 */
class BranchController extends AbstractController
{
    private $page = 'branch';

    /**
     * @Route("/", name="branch_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select b from App\Entity\Branch b order by b.id desc";
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
     * @Route("/new", name="branch_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $branch = new Branch();
        $form = $this->createForm(BranchType::class, $branch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($branch);
            $entityManager->flush();

            return $this->redirectToRoute('branch_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $branch,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="branch_show", methods={"GET"})
     */
    public function show(Branch $branch): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $branch,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="branch_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Branch $branch): Response
    {
        $form = $this->createForm(BranchType::class, $branch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('branch_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $branch,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="branch_delete", methods={"POST"})
     */
    public function delete(Request $request, Branch $branch): Response
    {
        if ($this->isCsrfTokenValid('delete'.$branch->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($branch);
            $entityManager->flush();
        }

        return $this->redirectToRoute('branch_index');
    }
}
