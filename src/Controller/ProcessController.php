<?php

namespace App\Controller;

use App\Entity\Process;
use App\Form\ProcessType;
use App\Repository\ProcessRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/process")
 */
class ProcessController extends AbstractController
{
    private $page = 'process';

    /**
     * @Route("/", name="process_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select p from App\Entity\Process p order by p.id desc";
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
     * @Route("/new", name="process_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $process = new Process();
        $form = $this->createForm(ProcessType::class, $process);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($process);
            $entityManager->flush();

            return $this->redirectToRoute('process_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $process,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="process_show", methods={"GET"})
     */
    public function show(Process $process): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $process,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="process_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Process $process): Response
    {
        $form = $this->createForm(ProcessType::class, $process);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('process_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $process,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="process_delete", methods={"POST"})
     */
    public function delete(Request $request, Process $process): Response
    {
        if ($this->isCsrfTokenValid('delete'.$process->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($process);
            $entityManager->flush();
        }

        return $this->redirectToRoute('process_index');
    }
}
