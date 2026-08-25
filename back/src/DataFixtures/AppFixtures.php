<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Shooting;
use App\Entity\Photo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // 1. Créer un admin
        $admin = new User();
        $admin->setName('Admin')
            ->setEmail('admin@test.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setIsAdmin(true);

        $hashedPassword = $this->passwordHasher->hashPassword($admin, 'admin123');
        $admin->setPassword($hashedPassword);

        $manager->persist($admin);

        // 2. Créer un client
        $client = new User();
        $client->setName('Client Test')
            ->setEmail('client@test.com')
            ->setRoles(['ROLE_USER'])
            ->setIsAdmin(false);

        $hashedPasswordClient = $this->passwordHasher->hashPassword($client, 'client123');
        $client->setPassword($hashedPasswordClient);

        $manager->persist($client);

        // 3. Créer un shooting
        $shooting = new Shooting();
        $shooting->setClient($client)
            ->setShootingDate(new \DateTimeImmutable('2024-12-15'))
            ->setStatus('terminé')
            
            ->setGalleryToken(bin2hex(random_bytes(16)));

        $manager->persist($shooting);

        // 4. Créer une photo
        $photo = new Photo();
        $photo->setPhotoUrl('https://images.unsplash.com/photo-1494790108755-2616c6c03a06?w=800')
            ->setDescription('Photo test')
            ->setShooting($shooting);

        $manager->persist($photo);

        $manager->flush();
    }
}
