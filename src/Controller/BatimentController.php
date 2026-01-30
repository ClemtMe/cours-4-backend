<?php

namespace App\Controller;

use App\Entity\Batiment;
use App\Repository\BatimentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BatimentController extends AbstractController
{
    #[Route('/batiments', name: 'app_batiment')]
    public function index(BatimentRepository $batimentRepository): Response
    {
        return $this->render('batiment/index.html.twig', [
            'batiments' => $batimentRepository->findAll(),
        ]);
    }

    #[Route('/batiments/{id}', name: 'app_batiment_show')]
    public function show(Batiment $batiment): Response
    {
        return $this->render('batiment/show.html.twig', [
            'batiment' => $batiment,
        ]);
    }
}
