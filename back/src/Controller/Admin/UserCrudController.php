<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\PasswordCreationToken;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class UserCrudController extends AbstractCrudController
{
    public function __construct(
        private MailerInterface $mailer
    ) {}

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            EmailField::new('email'),
            BooleanField::new('isAdmin', 'Admin'),
            ArrayField::new('roles')->hideOnForm(),
        ];
    }

    /**
     * Après création d’un utilisateur :
     * - génération du token
     * - envoi de l’email vers le front Next.js
     */
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof User) {
            return;
        }

        // Sauvegarde du user
        parent::persistEntity($entityManager, $entityInstance);

        // Génération du token
        $tokenValue = bin2hex(random_bytes(32));
        $hashedToken = hash('sha256', $tokenValue);

        $token = new PasswordCreationToken();
        $token->setClient($entityInstance);
        $token->setToken($hashedToken);

        $entityManager->persist($token);
        $entityManager->flush();

        // Lien vers le FRONT (Next.js)
        $frontUrl = rtrim($_ENV['FRONT_URL'], '/');
        $link = $frontUrl . '/password-change?token=' . $tokenValue;

        // Envoi email
        $email = (new Email())
            ->from($_ENV['MAILER_FROM'])
            ->to($entityInstance->getEmail())
            ->subject('Créez votre mot de passe')
            ->html("
                <p>Bonjour {$entityInstance->getName()},</p>
                <p>Pour créer votre mot de passe, cliquez sur le lien ci-dessous :</p>
                <p><a href='{$link}'>Créer mon mot de passe</a></p>
                <p>Ce lien est valable 24 heures.</p>
            ");

        $this->mailer->send($email);
    }
}