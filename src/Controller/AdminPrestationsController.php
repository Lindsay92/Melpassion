<?php

namespace App\Controller;

use App\Entity\Prestations;
use App\Form\PrestationsType;
use App\Repository\PrestationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/prestations')]
class AdminPrestationsController extends AbstractController
{
    #[Route('/', name: 'admin_prestations_index', methods: ['GET'])]
    public function index(PrestationsRepository $prestationsRepository): Response
    {
        return $this->render('admin_prestations/index.html.twig', [
            'prestations' => $prestationsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_prestations_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $prestation = new Prestations();
        $form = $this->createForm(PrestationsType::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prestation);
            $entityManager->flush();

            return $this->redirectToRoute('admin_prestations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_prestations/new.html.twig', [
            'prestation' => $prestation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_prestations_show', methods: ['GET'])]
    public function show(Prestations $prestation): Response
    {
        return $this->render('admin_prestations/show.html.twig', [
            'prestation' => $prestation,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_prestations_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Prestations $prestation): Response
    {
        $form = $this->createForm(PrestationsType::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_prestations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_prestations/edit.html.twig', [
            'prestation' => $prestation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_prestations_delete', methods: ['POST'])]
    public function delete(Request $request, Prestations $prestation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prestation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($prestation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_prestations_index', [], Response::HTTP_SEE_OTHER);
    }
}
