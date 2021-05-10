<?php

namespace App\Controller;

use App\Entity\Main;
use App\Form\MainType;
use App\Repository\MainRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/main")
 */
class MainController extends AbstractController
{
    /**
     * @Route("/index", name="main_index0", methods={"GET"})
     */
    public function index(MainRepository $mainRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'mains' => $mainRepository->findAll(),
        ]);
    }

    /**
     * @Route("/", name="main_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select m from App\Entity\Main m order by m.id desc";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);
        $p = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('main/paginate.html.twig', [
            'mains' => $p
        ]);
    }

    /**
     * @Route("/new", name="main_new", methods={"GET","POST"})
     */
    public function new(Request $request, MainRepository $mainRepository): Response
    {
        $main = new Main();
        $form = $this->createForm(MainType::class, $main);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($main);
            $entityManager->flush();

            return $this->redirectToRoute('main_index');
        }

        return $this->render('main/new.html.twig', [
            'main' => $main,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="main_show", methods={"GET"})
     */
    public function show(Main $main): Response
    {
        return $this->render('main/show.html.twig', [
            'main' => $main,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="main_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Main $main): Response
    {
        $form = $this->createForm(MainType::class, $main);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('main_index');
        }

        return $this->render('main/edit.html.twig', [
            'main' => $main,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="main_delete", methods={"POST"})
     */
    public function delete(Request $request, Main $main): Response
    {
        if ($this->isCsrfTokenValid('delete'.$main->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($main);
            $entityManager->flush();
        }

        return $this->redirectToRoute('main_index');
    }
}
