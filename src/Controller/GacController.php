<?php

namespace App\Controller;

use App\Entity\Gac;
use App\Form\GacType;
use App\Repository\GacRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/gac")
 */
class GacController extends AbstractController
{
    private $page = 'gac';

    /**
     * @Route("/", name="gac_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select g from App\Entity\Gac g order by g.id desc";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);
        $p = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('crud/index.html.twig', [
            'page' => $this->page,
            'items' => $p,
            'columns' => [
                ['name' => 'id'],
                ['name' => 'date'],
                ['name' => 'team'],
                ['name' => 'clerk'],
                ['name' => 'artisan'],
                ['name' => 'goldclass'],
                ['name' => 'position'],
                ['name' => 'weight'],
                ['name' => 'note'],
            ]
        ]);
    }

    /**
     * @Route("/new", name="gac_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $gac = new Gac();
        $gac->setDate(new \DateTimeImmutable());
        $gac->setClerk($this->getUser());
        $form = $this->createForm(GacType::class, $gac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gac);
            $entityManager->flush();

            return $this->redirectToRoute('gac_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $gac,
            'form' => $form->createView(),
            'weighing' => true
        ]);
    }

    /**
     * @Route("/{id}", name="gac_show", methods={"GET"})
     */
    public function show(Gac $gac): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $gac,
            'fields' => ['id', 'date', 'team', 'clerk', 'artisan', 'goldclass', 'position', 'weight', 'note']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="gac_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Gac $gac): Response
    {
        $form = $this->createForm(GacType::class, $gac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gac_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $gac,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gac_delete", methods={"POST"})
     */
    public function delete(Request $request, Gac $gac): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gac->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gac);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gac_index');
    }
}
