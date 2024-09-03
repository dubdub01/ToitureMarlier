<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Chantier;
use App\Form\ImagesType;
use App\Form\ChantierType;
use App\Entity\Commentaire;
use App\Repository\ChantierRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CommentaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


class AdminPhotoController extends AbstractController
{
    /**
     * Affiche la liste des Chantiers
     *
     * @param ChantierRepository $repo
     * @return Response
     */
    #[Route('/admin/photo', name: 'app_admin_photo')]
    public function index(ChantierRepository $repo): Response
    {
        return $this->render('admin_photo/index.html.twig', [
            'chantiers' => $repo->findAll(),
        ]);
    }

    #[Route('/admin/photo/new', name: 'app_admin_photo_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $chantier = new Chantier();
        $form = $this->createForm(ChantierType::class, $chantier);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            $imageLeftFile = $form->get('imageLeft')->getData();
            $imageRightFile = $form->get('imageRight')->getData();

            if ($imageFile) {
                $newFilename = $this->uploadFile($imageFile, $slugger);
                $chantier->setImage($newFilename);
            }
            if ($imageLeftFile) {
                $newFilename = $this->uploadFile($imageLeftFile, $slugger);
                $chantier->setImageleft($newFilename);
            }
            if ($imageRightFile) {
                $newFilename = $this->uploadFile($imageRightFile, $slugger);
                $chantier->setImageright($newFilename);
            }

            $entityManager->persist($chantier);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_photo');
        }

        return $this->render('admin_photo/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    private function uploadFile($file, SluggerInterface $slugger): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move(
                $this->getParameter('images_directory'),
                $newFilename
            );
        } catch (FileException $e) {
            // Handle exception if something happens during file upload
        }

        return $newFilename;
    }


    /**
     * Permet de supprimer un chantier
     */
    #[Route('/admin/photo/{id}/delete', name: 'app_admin_photo_delete', methods: ['POST'])]
    public function deleteimg(Request $request, Chantier $chantier, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chantier->getId(), $request->request->get('_token'))) {
            $entityManager->remove($chantier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_photo');
    }
   
/**
 * Permet de modifier un chantier
 */
#[Route('/admin/photo/{id}/edit', name: 'app_admin_photo_edit')]
public function edit(Chantier $chantier, Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
{
    $originalImage = $chantier->getImage();
    $originalImageLeft = $chantier->getImageLeft();
    $originalImageRight = $chantier->getImageRight();

    $form = $this->createForm(ChantierType::class, $chantier);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Handle main image
        $imageFile = $form->get('image')->getData();
        if ($imageFile) {
            $newFilename = $this->uploadFile($imageFile, $slugger);
            $chantier->setImage($newFilename);
        } else {
            $chantier->setImage($originalImage); // Retain the original image
        }

        // Handle left image
        $imageLeftFile = $form->get('imageLeft')->getData();
        if ($imageLeftFile) {
            $newFilenameLeft = $this->uploadFile($imageLeftFile, $slugger);
            $chantier->setImageLeft($newFilenameLeft);
        } else {
            $chantier->setImageLeft($originalImageLeft); // Retain the original left image
        }

        // Handle right image
        $imageRightFile = $form->get('imageRight')->getData();
        if ($imageRightFile) {
            $newFilenameRight = $this->uploadFile($imageRightFile, $slugger);
            $chantier->setImageRight($newFilenameRight);
        } else {
            $chantier->setImageRight($originalImageRight); // Retain the original right image
        }

        // Persist changes to the database
        $entityManager->flush();

        return $this->redirectToRoute('app_admin_photo');
    }

    return $this->render('admin_photo/edit.html.twig', [
        'form' => $form->createView(),
        'chantier' => $chantier,
    ]);
}




    
    /**
     * Affiche la liste des commentaires
     *
     * @param CommentaireRepository $repo
     * @return Response
     */
    #[Route('/admin/comm', name: 'app_admin_comm')]
    public function comm(CommentaireRepository $repo): Response
    {
        return $this->render('admin_photo/comm.html.twig', [
            'comms' => $repo->findAll(),
        ]);
    }

    /**
     * Parmet de rendre visible un commentaire
     */
    #[Route('/admin/comm/{id}/toggle-visibility', name: 'app_admin_comm_toggle_visibility')]
    public function toggleVisibility(Commentaire $commentaire, CommentaireRepository $repo): Response
    {
        $commentaire->setVisibility(!$commentaire->isVisibility());
        $repo->save($commentaire, true);

        return $this->redirectToRoute('app_comm');
    }
    
    /**
     * Permet de supprimer un commentaire
     */
    #[Route('/admin/comm/{id}/delete', name: 'app_admin_comm_delete', methods: ['POST'])]
    public function delete(Commentaire $commentaire, Request $request, CommentaireRepository $repo): Response
    {
        if ($this->isCsrfTokenValid('delete' . $commentaire->getId(), $request->request->get('_token'))) {
            $repo->remove($commentaire, true);
        }

        return $this->redirectToRoute('app_comm');
    }
}

