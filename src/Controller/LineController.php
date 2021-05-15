<?php

namespace App\Controller;

use App\Entity\Line;
use App\Form\LineType;
use App\Repository\LineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/line")
 */
class LineController extends AbstractController
{
    private $page = 'line';

    /**
     * @Route("/", name="line_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select l from App\Entity\Line l order by l.id desc";
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
     * @Route("/new", name="line_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $line = new Line();
        $form = $this->createForm(LineType::class, $line);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($line);
            $entityManager->flush();

            return $this->redirectToRoute('line_index');
        }

        return $this->render('line/new.html.twig', [
            'page' => $this->page,
            'item' => $line,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="line_show", methods={"GET"})
     */
    public function show(Line $line): Response
    {
        return $this->render('line/show.html.twig', [
            'page' => $this->page,
            'item' => $line,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="line_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Line $line): Response
    {
        $form = $this->createForm(LineType::class, $line);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('line_index');
        }

        return $this->render('line/edit.html.twig', [
            'page' => $this->page,
            'item' => $line,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="line_delete", methods={"POST"})
     */
    public function delete(Request $request, Line $line): Response
    {
        if ($this->isCsrfTokenValid('delete'.$line->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($line);
            $entityManager->flush();
        }

        return $this->redirectToRoute('line_index');
    }
}
