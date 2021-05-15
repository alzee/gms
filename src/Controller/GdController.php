<?php

namespace App\Controller;

use App\Entity\Gd;
use App\Form\GdType;
use App\Repository\GdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/gd")
 */
class GdController extends AbstractController
{
    private $page = 'gd';

    /**
     * @Route("/", name="gd_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select g from App\Entity\Gd g order by g.id desc";
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
     * @Route("/new", name="gd_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $gd = new Gd();
        $gd->setDate(new \DateTimeImmutable());
        $form = $this->createForm(GdType::class, $gd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gd);
            $entityManager->flush();

            return $this->redirectToRoute('gd_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $gd,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gd_show", methods={"GET"})
     */
    public function show(Gd $gd): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $gd,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="gd_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Gd $gd): Response
    {
        $form = $this->createForm(GdType::class, $gd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gd_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $gd,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gd_delete", methods={"POST"})
     */
    public function delete(Request $request, Gd $gd): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gd->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gd);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gd_index');
    }
}
