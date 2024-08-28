<?php

namespace App\Controller;

use App\Entity\Chantier;
use App\Repository\ChantierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ChantierController extends AbstractController
{
    #[Route('/chantier', name: 'app_chantier')]
    public function index(ChantierRepository $repo): Response
    {
        $chantiers = $repo->findAll();

        return $this->render('chantier/index.html.twig', [
            'chantiers' => $chantiers
        ]);
    }

    #[Route('/chantier/{id}', name: 'chantier_show')]
    public function show(Chantier $chantier): Response
    {
        return $this->render('chantier/show.html.twig', [
            'chantier' => $chantier
        ]);
    }
}
