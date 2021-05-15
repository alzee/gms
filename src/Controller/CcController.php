<?php

namespace App\Controller;

use App\Entity\Cc;
use App\Form\CcType;
use App\Repository\CcRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/cc")
 */
class CcController extends AbstractController
{
    private $page = 'cc';

    /**
     * @Route("/", name="cc_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select c from App\Entity\Cc c join c.sender u order by c.id desc";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);
        $p = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('crud/index.html.twig', [
            'page' => $this->page,
            'items' => $p,
            'columns' => [
                ['name' => 'id'],
                ['name' => 'date'],
                ['name' => 'team'],
                ['name' => 'recipient'],
                ['name' => 'goldclass'],
                ['name' => 'position'],
                ['name' => 'weight'],
                ['name' => 'sender'],
                ['name' => 'status'],
            ]
        ]);
    }

    /**
     * @Route("/got", name="cc_got", methods={"GET"})
     */
    public function got(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select c from App\Entity\Cc c join c.sender u order by c.id desc";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);
        $p = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('cc/got.html.twig', [
            'ccs' => $p
        ]);
    }

    /**
     * @Route("/confirm/{id}", name="cc_confirm", methods={"GET"})
     */
    public function confirm(Cc $cc): Response
    {
        $em = $this->getDoctrine()->getManager();
        $cc->setStatus(2);
        $cc->setDate1(new \DateTimeImmutable());
        $em->persist($cc);
        $em->flush();
        return $this->redirectToRoute('cc_got');
    }

    /**
     * @Route("/new", name="cc_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cc = new Cc();
        $cc->setDate(new \DateTimeImmutable());
        $cc->setSender($this->getUser());
        $form = $this->createForm(CcType::class, $cc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cc);
            $entityManager->flush();

            return $this->redirectToRoute('cc_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $cc,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cc_show", methods={"GET"})
     */
    public function show(Cc $cc): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $cc,
            'fields' => ['id', 'date', 'team', 'recipient', 'goldclass', 'position', 'weight', 'sender', 'status']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cc_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cc $cc): Response
    {
        $form = $this->createForm(CcType::class, $cc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cc_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $cc,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cc_delete", methods={"POST"})
     */
    public function delete(Request $request, Cc $cc): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cc->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cc);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cc_index');
    }
}
