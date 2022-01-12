<?php

namespace App\Controller;

use App\Repository\PrestationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrestationsController extends AbstractController
{
    #[Route('/prestations', name: 'prestations')]
    public function index(PrestationsRepository $prestationsRepository): Response
    {
        return $this->render('prestations/index.html.twig', [
            'prestations' => $prestationsRepository->findAll(),
        ]);
    }

    #[Route('/prestations/{slug}', name:'prestation-detail')]

    public function detail(PrestationsRepository $prestationsRepository, int $slug): Response
    {
        return $this->render('prestations/detail.html.twig',[
            "service" => $prestationsRepository->find($slug),
        ]);
    }
}
