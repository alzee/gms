<?php

namespace App\Controller;

use App\Entity\Gca;
use App\Form\GcaType;
use App\Repository\GcaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/gca")
 */
class GcaController extends AbstractController
{
    private $page = 'gca';

    /**
     * @Route("/", name="gca_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select g from App\Entity\Gca g order by g.id desc";
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
     * @Route("/new", name="gca_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $gca = new Gca();
        $gca->setDate(new \DateTimeImmutable());
        $gca->setClerk($this->getUser());
        $form = $this->createForm(GcaType::class, $gca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gca);
            $entityManager->flush();

            return $this->redirectToRoute('gca_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $gca,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gca_show", methods={"GET"})
     */
    public function show(Gca $gca): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $gca,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="gca_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Gca $gca): Response
    {
        $form = $this->createForm(GcaType::class, $gca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gca_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $gca,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gca_delete", methods={"POST"})
     */
    public function delete(Request $request, Gca $gca): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gca->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gca);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gca_index');
    }
}
