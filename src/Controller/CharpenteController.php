<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CharpenteController extends AbstractController
{
    #[Route('/charpente', name: 'app_charpente')]
    public function index(): Response
    {
        return $this->render('charpente/index.html.twig', [
            'controller_name' => 'CharpenteController',
        ]);
    }
}
