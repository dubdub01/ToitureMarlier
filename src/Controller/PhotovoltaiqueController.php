<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PhotovoltaiqueController extends AbstractController
{
    #[Route('/photovoltaique', name: 'app_photovoltaique')]
    public function index(): Response
    {
        return $this->render('photovoltaique/index.html.twig', [
            'controller_name' => 'PhotovoltaiqueController',
        ]);
    }
}
