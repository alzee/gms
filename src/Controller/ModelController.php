<?php

namespace App\Controller;

use App\Entity\Model;
use App\Form\ModelType;
use App\Repository\ModelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/model")
 */
class ModelController extends AbstractController
{
    private $page = 'model';

    /**
     * @Route("/", name="model_index", methods={"GET"})
     */
    public function paginate(PaginatorInterface $paginator, Request $request): Response
    {
        $dql = "select m from App\Entity\Model m order by m.id desc";
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
     * @Route("/new", name="model_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $model = new Model();
        $form = $this->createForm(ModelType::class, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($model);
            $entityManager->flush();

            return $this->redirectToRoute('model_index');
        }

        return $this->render('crud/new.html.twig', [
            'page' => $this->page,
            'item' => $model,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="model_show", methods={"GET"})
     */
    public function show(Model $model): Response
    {
        return $this->render('crud/show.html.twig', [
            'page' => $this->page,
            'item' => $model,
            'fields' => ['id', 'name']
        ]);
    }

    /**
     * @Route("/{id}/edit", name="model_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Model $model): Response
    {
        $form = $this->createForm(ModelType::class, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('model_index');
        }

        return $this->render('crud/edit.html.twig', [
            'page' => $this->page,
            'item' => $model,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="model_delete", methods={"POST"})
     */
    public function delete(Request $request, Model $model): Response
    {
        if ($this->isCsrfTokenValid('delete'.$model->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($model);
            $entityManager->flush();
        }

        return $this->redirectToRoute('model_index');
    }
}
