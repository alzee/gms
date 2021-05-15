<?php

namespace App\Controller;

use App\Entity\Ac;
use App\Form\AcType;
use App\Repository\AcRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/ac")
 */
class AcController extends AbstractController
{
    private $page = 'ac';

    /**
     * @Route("/", name="ac_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select a from App\Entity\Ac a order by a.id desc";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);
        $p = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('crud/index.html.twig', [
            'page' => $this->page,
            'items' => $p,
            'columns' => [
                ['name' => 'id'],
            ]
        ]);
    }

    /**
     * @Route("/new", name="ac_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ac = new Ac();
        $ac->setDate(new \DateTimeImmutable());
        $form = $this->createForm(AcType::class, $ac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ac);
            $entityManager->flush();

            return $this->redirectToRoute('ac_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $ac,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ac_show", methods={"GET"})
     */
    public function show(Ac $ac): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'ac' => $ac,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ac_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ac $ac): Response
    {
        $form = $this->createForm(AcType::class, $ac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ac_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $ac,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ac_delete", methods={"POST"})
     */
    public function delete(Request $request, Ac $ac): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ac->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ac);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ac_index');
    }
}
