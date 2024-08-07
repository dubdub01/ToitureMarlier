<?php

namespace App\DataFixtures;

use App\Entity\User;
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
        // $product = new Product();
        // $manager->persist($product);
        $admin = new User();
        $admin->setUsername('max')
            ->setPassword($this->passwordHasher->hashPassword($admin,'admin'))
            ->setRoles([]);
        $manager->persist($admin);
        
        $roland = new User();
        $roland->setUsername('roland')
            ->setPassword($this->passwordHasher->hashPassword($admin,'@Flea2909'))
            ->setRoles([]);
        $manager->persist($roland);

        $manager->flush();
    }
}
