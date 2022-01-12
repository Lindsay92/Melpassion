<?php

namespace App\Controller;

use App\Entity\Conditions;
use App\Form\ConditionsType;
use App\Repository\ConditionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/conditions')]
class AdminConditionsController extends AbstractController
{
    #[Route('/', name: 'admin_conditions_index', methods: ['GET'])]
    public function index(ConditionsRepository $conditionsRepository): Response
    {
        return $this->render('admin_conditions/index.html.twig', [
            'conditions' => $conditionsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_conditions_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $condition = new Conditions();
        $form = $this->createForm(ConditionsType::class, $condition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($condition);
            $entityManager->flush();

            return $this->redirectToRoute('admin_conditions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_conditions/new.html.twig', [
            'condition' => $condition,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_conditions_show', methods: ['GET'])]
    public function show(Conditions $condition): Response
    {
        return $this->render('admin_conditions/show.html.twig', [
            'condition' => $condition,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_conditions_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Conditions $condition): Response
    {
        $form = $this->createForm(ConditionsType::class, $condition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_conditions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_conditions/edit.html.twig', [
            'condition' => $condition,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_conditions_delete', methods: ['POST'])]
    public function delete(Request $request, Conditions $condition): Response
    {
        if ($this->isCsrfTokenValid('delete'.$condition->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($condition);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_conditions_index', [], Response::HTTP_SEE_OTHER);
    }
}
