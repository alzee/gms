<?php

namespace App\Controller;

use App\Entity\Stafftype;
use App\Form\StafftypeType;
use App\Repository\StafftypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/stafftype")
 */
class StafftypeController extends AbstractController
{
    /**
     * @Route("/", name="stafftype_index", methods={"GET"})
     */
    public function index(StafftypeRepository $stafftypeRepository): Response
    {
        return $this->render('stafftype/index.html.twig', [
            'stafftypes' => $stafftypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="stafftype_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $stafftype = new Stafftype();
        $form = $this->createForm(StafftypeType::class, $stafftype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stafftype);
            $entityManager->flush();

            return $this->redirectToRoute('stafftype_index');
        }

        return $this->render('stafftype/new.html.twig', [
            'stafftype' => $stafftype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stafftype_show", methods={"GET"})
     */
    public function show(Stafftype $stafftype): Response
    {
        return $this->render('stafftype/show.html.twig', [
            'stafftype' => $stafftype,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="stafftype_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Stafftype $stafftype): Response
    {
        $form = $this->createForm(StafftypeType::class, $stafftype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('stafftype_index');
        }

        return $this->render('stafftype/edit.html.twig', [
            'stafftype' => $stafftype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stafftype_delete", methods={"POST"})
     */
    public function delete(Request $request, Stafftype $stafftype): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stafftype->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($stafftype);
            $entityManager->flush();
        }

        return $this->redirectToRoute('stafftype_index');
    }
}
