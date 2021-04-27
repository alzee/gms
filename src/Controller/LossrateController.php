<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Lossrate;
use App\Form\LossrateType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/lossrate")
 */
class LossrateController extends AbstractController
{
    /**
     * @Route("/", name="lossrate")
     */
    public function index(): Response
    {
        return $this->render('lossrate/index.html.twig', [
            'controller_name' => 'LossrateController',
        ]);
    }

    /**
     * @Route("/new", name="lossrate_new")
     */
    public function new(Request $request): Response
    {
        $l = new Lossrate();
        $form = $this->createForm(LossrateType::class, $l);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $l = $form->getData();

            // ... perform some action, such as saving the task to the database
            $em = $this->getDoctrine()->getManager();
            $em->persist($l);
            $em->flush();

            // return $this->redirectToRoute('task_success');
        }

        return $this->render('lossrate/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
