<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;

class TestTokenController extends AbstractController
{
    #[Route('/test/token/{email}', name: 'test_token')]
    public function index(
        string $email,
        UserRepository $userRepository,
        ResetPasswordHelperInterface $resetPasswordHelper,
        MailerInterface $mailer,
        UrlGeneratorInterface $urlGenerator
    ): Response {

        // 1. récupérer user
        $user = $userRepository->findOneBy(['email' => $email]);

        if (!$user) {
            return new Response('User not found', 404);
        }

        // 2. générer token reset password
        $resetToken = $resetPasswordHelper->generateResetToken($user);

        // 3. générer URL reset password
        $resetUrl = $urlGenerator->generate(
            'app_reset_password',
            ['token' => $resetToken->getToken()],
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        // 4. envoyer email
        $emailMessage = (new Email())
            ->from('TONMAIL@gmail.com')
            ->to($user->getEmail())
            ->subject('Reset password')
            ->html("
                <p>Bonjour,</p>
                <p>Clique ici pour réinitialiser ton mot de passe :</p>
                <a href='$resetUrl'>Reset password</a>
            ");

        $mailer->send($emailMessage);

        return new Response('Email envoyé à ' . $email);
    }
}