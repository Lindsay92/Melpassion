<?php

namespace App\Controller;

use App\Entity\Realisation;
use App\Form\RealisationType;
use App\Repository\RealisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/realisation')]
class AdminRealisationController extends AbstractController
{
    #[Route('/', name: 'admin_realisation_index', methods: ['GET'])]
    public function index(RealisationRepository $realisationRepository): Response
    {
        return $this->render('admin_realisation/index.html.twig', [
            'realisations' => $realisationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_realisation_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $realisation = new Realisation();
        $form = $this->createForm(RealisationType::class, $realisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($realisation);
            $entityManager->flush();

            return $this->redirectToRoute('admin_realisation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_realisation/new.html.twig', [
            'realisation' => $realisation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_realisation_show', methods: ['GET'])]
    public function show(Realisation $realisation): Response
    {
        return $this->render('admin_realisation/show.html.twig', [
            'realisation' => $realisation,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_realisation_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Realisation $realisation): Response
    {
        $form = $this->createForm(RealisationType::class, $realisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_realisation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_realisation/edit.html.twig', [
            'realisation' => $realisation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_realisation_delete', methods: ['POST'])]
    public function delete(Request $request, Realisation $realisation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$realisation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($realisation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_realisation_index', [], Response::HTTP_SEE_OTHER);
    }
}
