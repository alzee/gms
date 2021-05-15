<?php

namespace App\Controller;

use App\Entity\Stafftype;
use App\Form\StafftypeType;
use App\Repository\StafftypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/stafftype")
 */
class StafftypeController extends AbstractController
{
    private $page = 'stafftype';

    /**
     * @Route("/", name="stafftype_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select s from App\Entity\Stafftype s order by s.id desc";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);
        $p = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('crud/index.html.twig', [
            'page' => $this->page,
            'items' => $p,
            'columns' => [
                ['name' => 'id'],
                ['name' => 'name'],
            ]
        ]);
    }

    /**
     * @Route("/new", name="stafftype_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $stafftype = new Stafftype();
        $form = $this->createForm(StafftypeType::class, $stafftype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stafftype);
            $entityManager->flush();

            return $this->redirectToRoute('stafftype_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $stafftype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stafftype_show", methods={"GET"})
     */
    public function show(Stafftype $stafftype): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $stafftype,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="stafftype_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Stafftype $stafftype): Response
    {
        $form = $this->createForm(StafftypeType::class, $stafftype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('stafftype_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $stafftype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stafftype_delete", methods={"POST"})
     */
    public function delete(Request $request, Stafftype $stafftype): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stafftype->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($stafftype);
            $entityManager->flush();
        }

        return $this->redirectToRoute('stafftype_index');
    }
}
