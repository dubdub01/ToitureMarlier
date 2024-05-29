<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DemoussageController extends AbstractController
{
    #[Route('/demoussage', name: 'app_demoussage')]
    public function index(): Response
    {
        return $this->render('demoussage/index.html.twig', [
            'controller_name' => 'DemoussageController',
        ]);
    }
}
