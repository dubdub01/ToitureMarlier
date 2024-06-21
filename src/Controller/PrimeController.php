<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PrimeController extends AbstractController
{
    #[Route('/prime', name: 'app_prime')]
    public function index(): Response
    {
        return $this->render('prime/index.html.twig', [
            'controller_name' => 'PrimeController',
        ]);
    }
}
