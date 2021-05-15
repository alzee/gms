<?php

namespace App\Controller;

use App\Entity\Seq;
use App\Form\SeqType;
use App\Repository\SeqRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/seq")
 */
class SeqController extends AbstractController
{
    private $page = 'seq';

    /**
     * @Route("/", name="seq_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select s from App\Entity\Seq s order by s.id desc";
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
     * @Route("/new", name="seq_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $seq = new Seq();
        $form = $this->createForm(SeqType::class, $seq);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($seq);
            $entityManager->flush();

            return $this->redirectToRoute('seq_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $seq,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="seq_show", methods={"GET"})
     */
    public function show(Seq $seq): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $seq,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="seq_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Seq $seq): Response
    {
        $form = $this->createForm(SeqType::class, $seq);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seq_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $seq,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="seq_delete", methods={"POST"})
     */
    public function delete(Request $request, Seq $seq): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seq->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($seq);
            $entityManager->flush();
        }

        return $this->redirectToRoute('seq_index');
    }
}
