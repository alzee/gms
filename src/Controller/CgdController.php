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
    /**
     * @Route("/index", name="cgd_index0", methods={"GET"})
     */
    public function index(CgdRepository $cgdRepository): Response
    {
        return $this->render('cgd/index.html.twig', [
            'cgds' => $cgdRepository->findAll(),
        ]);
    }

    /**
     * @Route("/", name="cgd_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select c from App\Entity\Cgd c join c.main m order by c.id desc";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);
        $p = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('cgd/paginate.html.twig', [
            'cgds' => $p
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

        return $this->render('cgd/new.html.twig', [
            'cgd' => $cgd,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cgd_show", methods={"GET"})
     */
    public function show(Cgd $cgd): Response
    {
        return $this->render('cgd/show.html.twig', [
            'cgd' => $cgd,
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

        return $this->render('cgd/edit.html.twig', [
            'cgd' => $cgd,
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
