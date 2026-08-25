<?php
namespace App\Service;

use App\Entity\User;
use App\Entity\PasswordCreationToken;
use Doctrine\ORM\EntityManagerInterface;

class PasswordCreationService
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function createToken(User $user): PasswordCreationToken
    {
        $token = new PasswordCreationToken();

        $token->setClient($user);
        $token->setToken(bin2hex(random_bytes(32)));
        $token->setIsUsed(false);

        $this->em->persist($token);
        $this->em->flush();

        return $token;
    }
}