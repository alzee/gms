<?php

namespace App\Controller;

use App\Entity\Gb;
use App\Form\GbType;
use App\Repository\GbRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/gb")
 */
class GbController extends AbstractController
{
    private $page = 'gb';

    /**
     * @Route("/", name="gb_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select g from App\Entity\Gb g order by g.id desc";
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
     * @Route("/new", name="gb_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $gb = new Gb();
        $gb->setDate(new \DateTimeImmutable());
        $gb->setWeightBooked(0);
        $gb->setShort(0);
        $form = $this->createForm(GbType::class, $gb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gb);
            $entityManager->flush();

            return $this->redirectToRoute('gb_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $gb,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gb_show", methods={"GET"})
     */
    public function show(Gb $gb): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $gb,
            'fields' => ['id']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="gb_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Gb $gb): Response
    {
        $form = $this->createForm(GbType::class, $gb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gb_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $gb,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gb_delete", methods={"POST"})
     */
    public function delete(Request $request, Gb $gb): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gb->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gb);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gb_index');
    }
}
