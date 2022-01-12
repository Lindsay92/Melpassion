<?php

namespace App\Controller;

use App\Entity\Astuces;
use App\Form\AstucesType;
use App\Repository\AstucesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/astuces')]
class AdminAstucesController extends AbstractController
{
    #[Route('/', name: 'admin_astuces_index', methods: ['GET'])]
    public function index(AstucesRepository $astucesRepository): Response
    {
        return $this->render('admin_astuces/index.html.twig', [
            'astuces' => $astucesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_astuces_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $astuce = new Astuces();
        $form = $this->createForm(AstucesType::class, $astuce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($astuce);
            $entityManager->flush();

            return $this->redirectToRoute('admin_astuces_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_astuces/new.html.twig', [
            'astuce' => $astuce,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_astuces_show', methods: ['GET'])]
    public function show(Astuces $astuce): Response
    {
        return $this->render('admin_astuces/show.html.twig', [
            'astuce' => $astuce,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_astuces_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Astuces $astuce): Response
    {
        $form = $this->createForm(AstucesType::class, $astuce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_astuces_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_astuces/edit.html.twig', [
            'astuce' => $astuce,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_astuces_delete', methods: ['POST'])]
    public function delete(Request $request, Astuces $astuce): Response
    {
        if ($this->isCsrfTokenValid('delete'.$astuce->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($astuce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_astuces_index', [], Response::HTTP_SEE_OTHER);
    }
}
