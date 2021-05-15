<?php

namespace App\Controller;

use App\Entity\Cgd;
use App\Form\CgdType;
use App\Repository\CgdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/cgd")
 */
class CgdController extends AbstractController
{
    private $page = 'cgd';

    /**
     * @Route("/", name="cgd_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select c from App\Entity\Cgd c join c.main m order by c.id desc";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);
        $p = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('crud/index.html.twig', [
            'page' => $this->page,
            'items' => $p,
            'columns' => [
                ['name' => 'id'],
                ['name' => 'date'],
                ['name' => 'child'],
                ['name' => 'goldclass'],
                ['name' => 'position'],
                ['name' => 'weight'],
                ['name' => 'note'],
            ]
        ]);
    }

    /**
     * @Route("/new", name="cgd_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cgd = new Cgd();
        $cgd->setDate(new \DateTimeImmutable());
        $form = $this->createForm(CgdType::class, $cgd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cgd);
            $entityManager->flush();

            return $this->redirectToRoute('cgd_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $cgd,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cgd_show", methods={"GET"})
     */
    public function show(Cgd $cgd): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $cgd,
            'fields' => ['id', 'date', 'child', 'goldclass', 'position', 'weight', 'note']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cgd_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cgd $cgd): Response
    {
        $form = $this->createForm(CgdType::class, $cgd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cgd_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $cgd,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cgd_delete", methods={"POST"})
     */
    public function delete(Request $request, Cgd $cgd): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cgd->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cgd);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cgd_index');
    }
}
