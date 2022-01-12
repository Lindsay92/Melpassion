<?php

namespace App\Controller;

use App\Repository\AstucesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AstucesController extends AbstractController
{
    #[Route('/astuces', name: 'astuces')]
    public function index(AstucesRepository $astucesRepository): Response
    {
        return $this->render('astuces/index.html.twig', [
            'astuces' => $astucesRepository->findAll(),
        ]);
    }
}
