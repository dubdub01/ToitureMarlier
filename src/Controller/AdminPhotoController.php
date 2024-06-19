<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\ChantierRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPhotoController extends AbstractController
{
    #[Route('/admin/photo', name: 'app_admin_photo')]
    public function index(ChantierRepository $repo): Response
    {
        return $this->render('admin_photo/index.html.twig', [
            'chantiers' => $repo ->findAll(),
        ]);
    }

    
}
