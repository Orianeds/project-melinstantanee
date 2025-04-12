<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements PasswordAuthenticatedUserInterface
{
    // UUID
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: 'true')]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?UuidInterface $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Email()]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(min: 6)]
    private ?string $password = null;

    #[ORM\Column]
    private ?bool $isAdmin = false; // Valeur par défaut

    // Dates de création et de mise à jour
    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\OneToMany(targetEntity: Shooting::class, mappedBy: 'client')]
    private Collection|ArrayCollection $shootings;

    #[ORM\OneToMany(targetEntity: PasswordCreationToken::class, mappedBy: 'client', orphanRemoval: true)]
    private Collection $passwordCreationTokens;

    public function __construct()
    {
        $this->shootings = new ArrayCollection();
        $this->passwordCreationTokens = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable(); // Définir la date de création
        $this->updatedAt = new \DateTimeImmutable(); // Définir la date de mise à jour
    }

    // Getter et Setter pour UUID
    public function getId(): ?UuidInterface
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        // assure qu'au moins ROLE_USER est présent
        if (!in_array('ROLE_USER', $roles)) {
            $roles[] = 'ROLE_USER';
        }

        $this->roles = array_unique($roles);

        return $this;
    }

    // Setter pour le mot de passe avec hashage
    public function setPassword(?string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function hashPassword(UserPasswordHasherInterface $passwordHasher, string $plainPassword): static
    {
        $this->password = $passwordHasher->hashPassword($this, $plainPassword);
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function isAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): static
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    public function getShootings(): Collection
    {
        return $this->shootings;
    }

    public function addShooting(Shooting $shooting): static
    {
        if (!$this->shootings->contains($shooting)) {
            $this->shootings->add($shooting);
            $shooting->setClient($this);
        }

        return $this;
    }

    public function removeShooting(Shooting $shooting): static
    {
        if ($this->shootings->removeElement($shooting)) {
            // set the owning side to null (unless already changed)
            if ($shooting->getClient() === $this) {
                $shooting->setClient(null);
            }
        }

        return $this;
    }

    public function getPasswordCreationTokens(): Collection
    {
        return $this->passwordCreationTokens;
    }

    public function addPasswordCreationToken(PasswordCreationToken $passwordCreationToken): static
    {
        if (!$this->passwordCreationTokens->contains($passwordCreationToken)) {
            $this->passwordCreationTokens->add($passwordCreationToken);
            $passwordCreationToken->setClient($this);
        }

        return $this;
    }

    public function removePasswordCreationToken(PasswordCreationToken $passwordCreationToken): static
    {
        if ($this->passwordCreationTokens->removeElement($passwordCreationToken)) {
            // set the owning side to null (unless already changed)
            if ($passwordCreationToken->getClient() === $this) {
                $passwordCreationToken->setClient(null);
            }
        }

        return $this;
    }

    // Getters et Setters pour les dates
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    #[ORM\PreUpdate]
    public function setUpdatedAtValue(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }
}
