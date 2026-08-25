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
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity(fields: ['email'], message: 'Un compte avec cet email existe déjà')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?UuidInterface $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: 'Le nom ne peut pas être vide')]
    #[Assert\Length(min: 2, max: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank(message: 'L\'email ne peut pas être vide')]
    #[Assert\Email(message: 'Veuillez entrer un email valide')]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = []; // rôle interne, on ne le modifie pas directement

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $password = null;

    #[ORM\Column]
    private ?bool $isAdmin = false;

    #[ORM\Column]
    private ?bool $mustChangePassword = true; // pour forcer l'utilisateur à changer son mot de passe

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\OneToMany(targetEntity: Shooting::class, mappedBy: 'client')]
    private Collection|ArrayCollection $shootings;

    #[ORM\OneToMany(targetEntity: PasswordCreationToken::class, mappedBy: 'client', orphanRemoval: true, cascade: ['remove'])]
    private Collection $passwordCreationTokens;

    public function __construct()
    {
        $this->shootings = new ArrayCollection();
        $this->passwordCreationTokens = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->roles = ['ROLE_USER'];
        $this->mustChangePassword = true;
    }

    public function getId(): ?UuidInterface { return $this->id; }
    public function getName(): ?string { return $this->name; }
    public function setName(string $name): static { $this->name = $name; return $this; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(string $email): static { $this->email = $email; return $this; }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        if ($this->isAdmin) $roles[] = 'ROLE_ADMIN';
        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        if (!in_array('ROLE_USER', $roles)) $this->roles[] = 'ROLE_USER';
        return $this;
    }

    public function getPassword(): ?string { return $this->password; }
    public function setPassword(?string $password): static { $this->password = $password; return $this; }
    public function hashPassword(UserPasswordHasherInterface $passwordHasher, string $plainPassword): static
    {
        $this->password = $passwordHasher->hashPassword($this, $plainPassword);
        $this->mustChangePassword = false;
        return $this;
    }

    public function eraseCredentials(): void
    {
    }

    public function isAdmin(): ?bool { return $this->isAdmin; }
    public function setIsAdmin(bool $isAdmin): static
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }

    public function mustChangePassword(): bool { return $this->mustChangePassword; }
    public function setMustChangePassword(bool $mustChangePassword): static
    {
        $this->mustChangePassword = $mustChangePassword;
        return $this;
    }

    public function getShootings(): Collection { return $this->shootings; }
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
            if ($shooting->getClient() === $this) $shooting->setClient(null);
        }
        return $this;
    }

    public function getPasswordCreationTokens(): Collection { return $this->passwordCreationTokens; }
    public function addPasswordCreationToken(PasswordCreationToken $token): static
    {
        if (!$this->passwordCreationTokens->contains($token)) {
            $this->passwordCreationTokens->add($token);
            $token->setClient($this);
        }
        return $this;
    }
    public function removePasswordCreationToken(PasswordCreationToken $token): static
    {
        if ($this->passwordCreationTokens->removeElement($token)) {
            if ($token->getClient() === $this) $token->setClient(null);
        }
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface { return $this->createdAt; }
    public function getUpdatedAt(): ?\DateTimeInterface { return $this->updatedAt; }

    #[ORM\PreUpdate]
    public function setUpdatedAtValue(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }
}
