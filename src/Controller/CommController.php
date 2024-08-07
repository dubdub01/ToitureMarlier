<?php

namespace App\Controller;

use App\Form\CommType;
use App\Entity\Commentaire;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CommentaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommController extends AbstractController
{
    #[Route('/comm', name: 'app_comm')]
    public function index(CommentaireRepository $repo): Response
    {
        $comms = $repo->findAll();

        return $this->render('comm/index.html.twig', [
            'comms' => $comms
        ]);
    }
    
    /**
     * Permet de créer un Commentaire
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/comm/new', name: 'comm_create')]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $comm = new Commentaire();

        $form = $this->createForm(CommType::class, $comm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {

            $manager->persist($comm);
            $manager->flush();

            $this->addFlash(
                'success',
                "votre commentaire à bien été créé "
            );
            return $this->redirectToRoute(('app_homepage'));
        }

        return $this->render("comm/new.html.twig",[
            'myform' => $form->createView()
        ]);
       

    }

}
