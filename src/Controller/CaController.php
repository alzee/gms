<?php

namespace App\Controller;

use App\Entity\Ca;
use App\Entity\Child;
use App\Form\CaType;
use App\Repository\CaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/ca")
 */
class CaController extends AbstractController
{
    private $page = 'ca';

    /**
     * @Route("/", name="ca_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select c, ch, a from App\Entity\Ca c join c.child ch join c.artisan a order by c.id desc";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);
        $p = $paginator->paginate($query, $request->query->getInt('page', 1), 10);
        
        /*
        return $this->render('crud/index.html.twig', [
            'page' => $this->page,
            'items' => $p,
            'columns' => [
                ['name' => 'id'],
            ]
        ]);
         */

        return $this->render('ca/paginate.html.twig', [
            'cas' => $p
        ]);
    }

    /**
     * @Route("/back", name="ca_back", methods={"GET"})
     */
    public function back(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select c from App\Entity\Ca c join c.child ch order by c.id desc";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);
        $p = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('ca/back.html.twig', [
            'cas' => $p
        ]);
    }

    /**
     * @Route("/confirm/{id}", name="ca_confirm", methods={"GET"})
     */
    public function confirm(Ca $ca): Response
    {
        $em = $this->getDoctrine()->getManager();
        $ca->setStatus(2);
        $ca->setDate1(new \DateTimeImmutable());
        $em->persist($ca);
        $em->flush();
        return $this->redirectToRoute('ca_index');
    }

    /**
     * @Route("/receive/{id}", name="ca_receive", methods={"GET"})
     */
    public function receive(Ca $ca): Response
    {
        return $this->render('ca/receive.html.twig', [
            'ca' => $ca,
        ]);
    }

    /**
     * @Route("/new", name="ca_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ca = new Ca();
        $ca->setClerk($this->getUser());
        $ca->setDate(new \DateTimeImmutable());
        $form = $this->createForm(CaType::class, $ca);
        $form->handleRequest($request);
        $doc = $request->request->get('doc');

        if ($form->isSubmitted() && $form->isValid()) {
            // check if $doc is main or child
            //
            if (true) {
                $child = $this->getDoctrine()->getRepository(Child::class)->findOneBy(['sn' => $doc]);
            }
            else {
            }
            $form->getData()->setChild($child);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ca);
            $entityManager->flush();

            return $this->redirectToRoute('ca_index');
        }

        return $this->render('ca/new.html.twig', [
            'ca' => $ca,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ca_show", methods={"GET"})
     */
    public function show(Ca $ca): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $ca,
            'fields' => ['id', 'child', 'clerk', 'weightGold', 'weightAttach', 'craft', 'artisan' , 'date']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ca_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ca $ca): Response
    {
        $form = $this->createForm(CaType::class, $ca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ca_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $ca,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ca_delete", methods={"POST"})
     */
    public function delete(Request $request, Ca $ca): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ca->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ca);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ca_index');
    }
}
