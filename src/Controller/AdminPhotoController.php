<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminPhotoController extends AbstractController
{
    #[Route('/admin/photo', name: 'app_admin_photo')]
    public function index(): Response
    {
        return $this->render('admin_photo/index.html.twig', [
            'controller_name' => 'AdminPhotoController',
        ]);
    }
}
