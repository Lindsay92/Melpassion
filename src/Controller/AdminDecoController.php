<?php

namespace App\Controller;

use App\Entity\Deco;
use App\Form\DecoType;
use App\Repository\DecoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/deco')]
class AdminDecoController extends AbstractController
{
    #[Route('/', name: 'admin_deco_index', methods: ['GET'])]
    public function index(DecoRepository $decoRepository): Response
    {
        return $this->render('admin_deco/index.html.twig', [
            'decos' => $decoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_deco_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $deco = new Deco();
        $form = $this->createForm(DecoType::class, $deco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($deco);
            $entityManager->flush();

            return $this->redirectToRoute('admin_deco_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_deco/new.html.twig', [
            'deco' => $deco,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_deco_show', methods: ['GET'])]
    public function show(Deco $deco): Response
    {
        return $this->render('admin_deco/show.html.twig', [
            'deco' => $deco,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_deco_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Deco $deco): Response
    {
        $form = $this->createForm(DecoType::class, $deco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_deco_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_deco/edit.html.twig', [
            'deco' => $deco,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_deco_delete', methods: ['POST'])]
    public function delete(Request $request, Deco $deco): Response
    {
        if ($this->isCsrfTokenValid('delete'.$deco->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($deco);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_deco_index', [], Response::HTTP_SEE_OTHER);
    }
}
