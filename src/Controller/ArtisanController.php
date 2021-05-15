<?php

namespace App\Controller;

use App\Entity\Artisan;
use App\Form\ArtisanType;
use App\Repository\ArtisanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/artisan")
 */
class ArtisanController extends AbstractController
{
    private $page = 'artisan';

    /**
     * @Route("/", name="artisan_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select a from App\Entity\Artisan a order by a.id desc";
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
     * @Route("/new", name="artisan_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $artisan = new Artisan();
        $form = $this->createForm(ArtisanType::class, $artisan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($artisan);
            $entityManager->flush();

            return $this->redirectToRoute('artisan_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $artisan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="artisan_show", methods={"GET"})
     */
    public function show(Artisan $artisan): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $artisan,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="artisan_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Artisan $artisan): Response
    {
        $form = $this->createForm(ArtisanType::class, $artisan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('artisan_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $artisan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="artisan_delete", methods={"POST"})
     */
    public function delete(Request $request, Artisan $artisan): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artisan->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($artisan);
            $entityManager->flush();
        }

        return $this->redirectToRoute('artisan_index');
    }
}
