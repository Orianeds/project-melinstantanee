<?php

namespace App\Entity;

use App\Repository\PasswordCreationTokenRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PasswordCreationTokenRepository::class)]
class PasswordCreationToken
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'passwordCreationTokens')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $client = null;

    #[ORM\Column(length: 255)]
    private ?string $token = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $expiresAt = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column]
    private ?bool $isUsed = false; //Valeur par défaut à false

    public function __construct()
    {
        // Initialisation de la date de création à la date actuelle
        $this->createdAt = new \DateTime();

        // Expiration du token dans 24 heures
        $this->expiresAt = (new \DateTime())->modify('+1 day'); // Token valable 24h

        // Initialisation de isUsed à false par défaut
        $this->isUsed = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): static
    {
        $this->token = $token;

        return $this;
    }

    public function getExpiresAt(): ?\DateTimeInterface
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(\DateTimeInterface $expiresAt): static
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    public function isExpired(): bool
    {
        return new \DateTime() > $this->expiresAt;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function isUsed(): ?bool
    {
        return $this->isUsed;
    }

    public function setIsUsed(bool $isUsed): static
    {
        $this->isUsed = $isUsed;

        return $this;
    }
}
