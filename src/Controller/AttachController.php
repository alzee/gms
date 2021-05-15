<?php

namespace App\Controller;

use App\Entity\Attach;
use App\Form\AttachType;
use App\Repository\AttachRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/attach")
 */
class AttachController extends AbstractController
{
    private $page = 'attach';

    /**
     * @Route("/", name="attach_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select a from App\Entity\Attach a order by a.id desc";
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
     * @Route("/new", name="attach_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $attach = new Attach();
        $form = $this->createForm(AttachType::class, $attach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($attach);
            $entityManager->flush();

            return $this->redirectToRoute('attach_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $attach,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="attach_show", methods={"GET"})
     */
    public function show(Attach $attach): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $attach,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="attach_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Attach $attach): Response
    {
        $form = $this->createForm(AttachType::class, $attach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('attach_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $attach,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="attach_delete", methods={"POST"})
     */
    public function delete(Request $request, Attach $attach): Response
    {
        if ($this->isCsrfTokenValid('delete'.$attach->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($attach);
            $entityManager->flush();
        }

        return $this->redirectToRoute('attach_index');
    }
}
