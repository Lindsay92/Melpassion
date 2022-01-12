<?php

namespace App\Controller;

use App\Repository\MentionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MentionsController extends AbstractController
{
    #[Route('/mentions', name: 'mentions')]
    public function index(MentionsRepository $mentionsRepository): Response
    {
        return $this->render('mentions/index.html.twig', [
            'mentionsLegales' => $mentionsRepository->findAll(),
        ]);
    }
}
