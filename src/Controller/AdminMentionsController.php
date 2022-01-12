<?php

namespace App\Controller;

use App\Entity\Mentions;
use App\Form\MentionsType;
use App\Repository\MentionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/mentions')]
class AdminMentionsController extends AbstractController
{
    #[Route('/', name: 'admin_mentions_index', methods: ['GET'])]
    public function index(MentionsRepository $mentionsRepository): Response
    {
        return $this->render('admin_mentions/index.html.twig', [
            'mentions' => $mentionsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_mentions_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $mention = new Mentions();
        $form = $this->createForm(MentionsType::class, $mention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mention);
            $entityManager->flush();

            return $this->redirectToRoute('admin_mentions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_mentions/new.html.twig', [
            'mention' => $mention,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_mentions_show', methods: ['GET'])]
    public function show(Mentions $mention): Response
    {
        return $this->render('admin_mentions/show.html.twig', [
            'mention' => $mention,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_mentions_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Mentions $mention): Response
    {
        $form = $this->createForm(MentionsType::class, $mention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_mentions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_mentions/edit.html.twig', [
            'mention' => $mention,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_mentions_delete', methods: ['POST'])]
    public function delete(Request $request, Mentions $mention): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mention->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mention);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_mentions_index', [], Response::HTTP_SEE_OTHER);
    }
}
