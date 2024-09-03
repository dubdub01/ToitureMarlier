<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        if ($request->isMethod('POST')) {
            // Récupérer les données du formulaire
            $nom = $request->request->get('name');
            $telephone = $request->request->get('Phone');
            $ville = $request->request->get('Address');

            // Créer le contenu de l'e-mail
            $messageContent = sprintf(
                "Nom: %s\nTéléphone: %s\nVille: %s",
                $nom,
                $telephone,
                $ville
            );

            try {
                // Créer et envoyer l'e-mail
                $email = (new Email())
                    ->from('noreply@wip.duboismax.com') // Remplacez par votre adresse e-mail
                    ->to('duboismax01@gmail.com') // Remplacez par l'adresse e-mail de réception
                    ->subject(sprintf('Nouvelle demande de contact de %s', $nom)) // Inclure le nom dans l'objet
                    ->text($messageContent);

                $mailer->send($email);

                // Ajouter un message flash de succès
                $this->addFlash('success', 'Votre demande a été envoyée avec succès.');

            } catch (\Exception $e) {
                // Ajouter un message flash d'erreur en cas d'échec
                $this->addFlash('error', 'Une erreur est survenue lors de l\'envoi de votre demande. Veuillez réessayer plus tard.');
            }

            // Rediriger ou afficher un message de succès
            return $this->redirectToRoute('contact'); // Changez la route si nécessaire
        }

        return $this->render('contact/index.html.twig');
    }
}
