<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminMessageController extends AbstractController
{
    #[Route('/admin/message', name: 'admin_message')]
    public function index(ContactRepository $contactRepository): Response
    {
        return $this->render('admin_message/index.html.twig', [
            'messages' => $contactRepository->findAll(),
        ]);
    }

    #[Route('/admin/message/delete{id}', name: 'delete_message')]
    public function deleteMessage(int $id, ContactRepository $contactRepository):Response
    {
        //récupération de l'entitymanager
        $em = $this->getDoctrine()->getManager();
        //récupération du contact
        $contact = $contactRepository->find($id);
        //update bdd - suppression du contact
        $em->remove($contact);
        $em->flush();

        return $this->redirectToRoute('admin_message');
    }
}
