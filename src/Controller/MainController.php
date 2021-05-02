<?php

namespace App\Controller;

use App\Entity\Main;
use App\Form\MainType;
use App\Repository\MainRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/main")
 */
class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_index", methods={"GET"})
     */
    public function index(MainRepository $mainRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'mains' => $mainRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="main_new", methods={"GET","POST"})
     */
    public function new(Request $request, MainRepository $mainRepository): Response
    {
        $main = new Main();
        $date = new \DateTimeImmutable;
        $main->setDate($date);
        $form = $this->createForm(MainType::class, $main);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sn = $date->format('Ymd') . 0 . $request->request->get('main')['doctype'] . str_pad(1, 4, '0', STR_PAD_LEFT);;
            $main->setSn('');
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
