<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Commentaire; // Import de l'entité Commentaire
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Création des utilisateurs
        $admin = new User();
        $admin->setUsername('max')
            ->setPassword($this->passwordHasher->hashPassword($admin, 'admin'))
            ->setRoles([]);
        $manager->persist($admin);

        $roland = new User();
        $roland->setUsername('roland')
            ->setPassword($this->passwordHasher->hashPassword($roland, '@Flea2909'))
            ->setRoles([]);
        $manager->persist($roland);

        // Création des commentaires
        $commentaire1 = new Commentaire();
        $commentaire1->setNom('D.')
            ->setPrenom('Alix')
            ->setVille('Chaumont-Gistoux')
            ->setTexte('Prise de rendez-vous rapide; Devis très clair et rapide')
            ->setNote(5)
            ->setVisibility(true);
        $manager->persist($commentaire1);

        $commentaire2 = new Commentaire();
        $commentaire2->setNom('V.')
            ->setPrenom('Jean-Pierre')
            ->setVille('Bruxelles')
            ->setTexte('Bon contact, devis détaillé, prix dans la moyenne')
            ->setNote(4)
            ->setVisibility(true);
        $manager->persist($commentaire2);

        $commentaire3 = new Commentaire();
        $commentaire3->setNom('G.')
            ->setPrenom('Norbert')
            ->setVille('Brussels')
            ->setTexte('Une expérience positive: devis détaillé, bon prix et qualité, très professionnel. Recommandé!')
            ->setNote(5)
            ->setVisibility(true);
        $manager->persist($commentaire3);

        $commentaire4 = new Commentaire();
        $commentaire4->setNom('M.')
            ->setPrenom('Mary')
            ->setVille('Bruxelles')
            ->setTexte('Réaction rapide, professionnel, à l’écoute, offre raisonnable.')
            ->setNote(5)
            ->setVisibility(true);
        $manager->persist($commentaire4);
        
        $commentaire5 = new Commentaire();
        $commentaire5->setNom('B.')
            ->setPrenom('José')
            ->setVille('Hélécine')
            ->setTexte("La firme m'a fixé un rdv mais ne s'est jamais présentée!")
            ->setNote(2)
            ->setVisibility(false);
        $manager->persist($commentaire5);
        
        $commentaire6 = new Commentaire();
        $commentaire6->setNom('A.')
            ->setPrenom('Olivier')
            ->setVille('Soignies')
            ->setTexte("Sympathique")
            ->setNote(4)
            ->setVisibility(true);
        $manager->persist($commentaire6);
        
        $commentaire7 = new Commentaire();
        $commentaire7->setNom('B.')
            ->setPrenom('Genevieve')
            ->setVille('Charleroi')
            ->setTexte("Excellent")
            ->setNote(5)
            ->setVisibility(true);
        $manager->persist($commentaire7);
        
        $commentaire8 = new Commentaire();
        $commentaire8->setNom('E.')
            ->setPrenom('Rosa')
            ->setVille('Waterloo')
            ->setTexte("Personne très sérieuse explication claire disponibilité parfaite")
            ->setNote(5)
            ->setVisibility(true);
        $manager->persist($commentaire8);

        // Sauvegarde de tous les objets en base de données
        $manager->flush();
    }
}
