<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CouvertureController extends AbstractController
{
    #[Route('/couverture', name: 'app_couverture')]
    public function index(): Response
    {
        return $this->render('couverture/index.html.twig', [
            'controller_name' => 'CouvertureController',
        ]);
    }
}
