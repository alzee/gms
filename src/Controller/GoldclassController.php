<?php

namespace App\Controller;

use App\Entity\Goldclass;
use App\Form\GoldclassType;
use App\Repository\GoldclassRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/goldclass")
 */
class GoldclassController extends AbstractController
{
    private $page = 'goldclass';

    /**
     * @Route("/", name="goldclass_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select g from App\Entity\Goldclass g order by g.id desc";
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
     * @Route("/new", name="goldclass_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $goldclass = new Goldclass();
        $form = $this->createForm(GoldclassType::class, $goldclass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($goldclass);
            $entityManager->flush();

            return $this->redirectToRoute('goldclass_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $goldclass,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="goldclass_show", methods={"GET"})
     */
    public function show(Goldclass $goldclass): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $goldclass,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="goldclass_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Goldclass $goldclass): Response
    {
        $form = $this->createForm(GoldclassType::class, $goldclass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('goldclass_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $goldclass,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="goldclass_delete", methods={"POST"})
     */
    public function delete(Request $request, Goldclass $goldclass): Response
    {
        if ($this->isCsrfTokenValid('delete'.$goldclass->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($goldclass);
            $entityManager->flush();
        }

        return $this->redirectToRoute('goldclass_index');
    }
}
