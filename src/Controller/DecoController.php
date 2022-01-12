<?php

namespace App\Controller;

use App\Repository\DecoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DecoController extends AbstractController
{
    #[Route('/deco', name: 'deco')]
    public function index(DecoRepository $decoRepository): Response
    {
        return $this->render('deco/index.html.twig', [
            'deco' => $decoRepository->findAll(),
        ]);
    }
}
