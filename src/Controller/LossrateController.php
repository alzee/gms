<?php

namespace App\Controller;

use App\Entity\Lossrate;
use App\Form\LossrateType;
use App\Repository\LossrateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/lossrate")
 */
class LossrateController extends AbstractController
{
    private $page = 'lossrate';

    /**
     * @Route("/", name="lossrate_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select l from App\Entity\Lossrate l order by l.id desc";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);
        $p = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('crud/index.html.twig', [
            'page' => $this->page,
            'items' => $p,
            'columns' => [
                ['name' => 'id'],
                ['name' => 'name'],
                ['name' => 'model'],
                ['name' => 'craft'],
                ['name' => 'rate'],
                ['name' => 'note'],
            ]
        ]);
    }

    /**
     * @Route("/new", name="lossrate_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lossrate = new Lossrate();
        $form = $this->createForm(LossrateType::class, $lossrate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lossrate);
            $entityManager->flush();

            return $this->redirectToRoute('lossrate_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $lossrate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lossrate_show", methods={"GET"})
     */
    public function show(Lossrate $lossrate): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $lossrate,
            'fields' => ['id', 'name', 'model', 'craft', 'rate', 'note']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lossrate_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Lossrate $lossrate): Response
    {
        $form = $this->createForm(LossrateType::class, $lossrate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lossrate_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $lossrate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lossrate_delete", methods={"POST"})
     */
    public function delete(Request $request, Lossrate $lossrate): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lossrate->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lossrate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lossrate_index');
    }
}
