<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ToitureController extends AbstractController
{
    #[Route('/toiture', name: 'app_toiture')]
    public function index(): Response
    {
        return $this->render('toiture/index.html.twig', [
            'controller_name' => 'ToitureController',
        ]);
    }
}
