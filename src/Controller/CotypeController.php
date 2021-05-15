<?php

namespace App\Controller;

use App\Entity\Cotype;
use App\Form\CotypeType;
use App\Repository\CotypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/cotype")
 */
class CotypeController extends AbstractController
{
    private $page = 'cotype';

    /**
     * @Route("/", name="cotype_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select c from App\Entity\Cotype c order by c.id desc";
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
     * @Route("/new", name="cotype_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cotype = new Cotype();
        $form = $this->createForm(CotypeType::class, $cotype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cotype);
            $entityManager->flush();

            return $this->redirectToRoute('cotype_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $cotype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cotype_show", methods={"GET"})
     */
    public function show(Cotype $cotype): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $cotype,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cotype_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cotype $cotype): Response
    {
        $form = $this->createForm(CotypeType::class, $cotype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cotype_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $cotype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cotype_delete", methods={"POST"})
     */
    public function delete(Request $request, Cotype $cotype): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cotype->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cotype);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cotype_index');
    }
}
