<?php

namespace App\Controller;

use App\Entity\Sgb;
use App\Form\SgbType;
use App\Repository\SgbRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/sgb")
 */
class SgbController extends AbstractController
{
    private $page = 'sgb';

    /**
     * @Route("/", name="sgb_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select s from App\Entity\Sgb s order by s.id desc";
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
     * @Route("/new", name="sgb_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sgb = new Sgb();
        $sgb->setDate(new \DateTimeImmutable());
        $form = $this->createForm(SgbType::class, $sgb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sgb);
            $entityManager->flush();

            return $this->redirectToRoute('sgb_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $sgb,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sgb_show", methods={"GET"})
     */
    public function show(Sgb $sgb): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $sgb,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sgb_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sgb $sgb): Response
    {
        $form = $this->createForm(SgbType::class, $sgb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sgb_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $sgb,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sgb_delete", methods={"POST"})
     */
    public function delete(Request $request, Sgb $sgb): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sgb->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sgb);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sgb_index');
    }
}
