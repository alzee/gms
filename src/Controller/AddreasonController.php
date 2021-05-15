<?php

namespace App\Controller;

use App\Entity\Addreason;
use App\Form\AddreasonType;
use App\Repository\AddreasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/addreason")
 */
class AddreasonController extends AbstractController
{
    private $page = 'addreason';

    /**
     * @Route("/", name="addreason_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select a from App\Entity\Addreason a order by a.id desc";
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
     * @Route("/new", name="addreason_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $addreason = new Addreason();
        $form = $this->createForm(AddreasonType::class, $addreason);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($addreason);
            $entityManager->flush();

            return $this->redirectToRoute('addreason_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $addreason,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="addreason_show", methods={"GET"})
     */
    public function show(Addreason $addreason): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'addreason' => $addreason,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="addreason_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Addreason $addreason): Response
    {
        $form = $this->createForm(AddreasonType::class, $addreason);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('addreason_index');
        }

        return $this->render('crud/edit.html.twig', [
            'item' => $addreason,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="addreason_delete", methods={"POST"})
     */
    public function delete(Request $request, Addreason $addreason): Response
    {
        if ($this->isCsrfTokenValid('delete'.$addreason->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($addreason);
            $entityManager->flush();
        }

        return $this->redirectToRoute('addreason_index');
    }
}
