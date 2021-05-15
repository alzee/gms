<?php

namespace App\Controller;

use App\Entity\Granule;
use App\Form\GranuleType;
use App\Repository\GranuleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/granule")
 */
class GranuleController extends AbstractController
{
    private $page = 'granule';

    /**
     * @Route("/", name="granule_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select g from App\Entity\Granule g order by g.id desc";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);
        $p = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('crud/index.html.twig', [
            'page' => $this->page,
            'items' => $p,
            'columns' => [
                ['name' => 'id'],
                ['name' => 'name'],
                ['name' => 'granule'],
            ]
        ]);
    }

    /**
     * @Route("/new", name="granule_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $granule = new Granule();
        $form = $this->createForm(GranuleType::class, $granule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($granule);
            $entityManager->flush();

            return $this->redirectToRoute('granule_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $granule,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="granule_show", methods={"GET"})
     */
    public function show(Granule $granule): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $granule,
            'fields' => ['id', 'name', 'granule']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="granule_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Granule $granule): Response
    {
        $form = $this->createForm(GranuleType::class, $granule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('granule_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $granule,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="granule_delete", methods={"POST"})
     */
    public function delete(Request $request, Granule $granule): Response
    {
        if ($this->isCsrfTokenValid('delete'.$granule->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($granule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('granule_index');
    }
}
