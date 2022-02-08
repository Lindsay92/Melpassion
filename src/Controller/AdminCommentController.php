<?php

namespace App\Controller;

use App\Repository\CommentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCommentController extends AbstractController
{
    #[Route('/admin/comment', name: 'admin_comment')]
    public function index(CommentsRepository $commentsRepository): Response
    {
        return $this->render('admin_comment/index.html.twig', [
            'commentaires' => $commentsRepository->findAll(),
        ]);
    }

    #[Route('/admin/comment/delete{id}', name: 'delete_comment')]
    public function deleteComment(int $id, CommentsRepository $commentsRepository):Response
    {
        //récupération de l'entitymanager
        $em = $this->getDoctrine()->getManager();
        //récupération du contact
        $comments = $commentsRepository->find($id);

        //update bdd - suppression du contact
        $em->remove($comments);
        $em->flush();

        return $this->redirectToRoute('admin_comment');
    }
}
