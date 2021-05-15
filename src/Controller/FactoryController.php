<?php

namespace App\Controller;

use App\Entity\Factory;
use App\Form\FactoryType;
use App\Repository\FactoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/factory")
 */
class FactoryController extends AbstractController
{
    private $page = 'factory';

    /**
     * @Route("/", name="factory_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select f from App\Entity\Factory f order by f.id desc";
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
     * @Route("/new", name="factory_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $factory = new Factory();
        $form = $this->createForm(FactoryType::class, $factory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($factory);
            $entityManager->flush();

            return $this->redirectToRoute('factory_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $factory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="factory_show", methods={"GET"})
     */
    public function show(Factory $factory): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $factory,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="factory_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Factory $factory): Response
    {
        $form = $this->createForm(FactoryType::class, $factory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('factory_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $factory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="factory_delete", methods={"POST"})
     */
    public function delete(Request $request, Factory $factory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$factory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($factory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('factory_index');
    }
}
