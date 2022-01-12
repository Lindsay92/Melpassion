<?php

namespace App\Controller;

use App\Repository\ConditionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConditionsController extends AbstractController
{
    #[Route('/conditions', name: 'conditions')]
    public function index(ConditionsRepository $conditionsRepository): Response
    {
        return $this->render('conditions/index.html.twig', [
            'conditions' => $conditionsRepository->findAll(),
        ]);
    }
}
