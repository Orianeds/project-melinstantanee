<?php

namespace App\Entity;

use App\Repository\ShootingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: ShootingRepository::class)]
#[ORM\HasLifecycleCallbacks] // Assure que les callbacks de Doctrine (comme PreUpdate) soient exécutés
class Shooting
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    // Définir client_id comme un UUID
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'shootings')]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id', nullable: false)]
    private ?User $client = null;

    // Date du shooting
    #[ORM\Column(type: 'datetime')]
    #[Assert\NotBlank]
    private \DateTimeInterface $shootingDate;

    // Statut du shooting (par exemple, "en cours", "terminé", "annulé")
    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank]
    #[Assert\Choice(choices: ['en cours', 'terminé', 'annulé'], message: 'Statut invalide.')]
    private string $status;

    // Lien vers le dossier du drive (pour stocker les photos)
    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Url]
    private ?string $driveLink = null;

    // Relation OneToMany avec l'entité Photo
    #[ORM\OneToMany(mappedBy: 'shooting', targetEntity: Photo::class, orphanRemoval: true)]
    private Collection $photos;

    // Notes (optionnelles)
    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $notes = null;

    // Date de création
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeInterface $createdAt;

    // Date de mise à jour
    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    public function __construct()
    {
        // Initialisation des dates
        $this->createdAt = new \DateTime();
        $this->status = 'en cours';  // Valeur par défaut
        $this->photos = new ArrayCollection();
    }

    // Getter et Setter pour l'ID
    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter et Setter pour le client (User)
    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): static
    {
        $this->client = $client;

        return $this;
    }

    // Getter et Setter pour la date du shooting
    public function getShootingDate(): \DateTimeInterface
    {
        return $this->shootingDate;
    }

    public function setShootingDate(\DateTimeInterface $shootingDate): static
    {
        $this->shootingDate = $shootingDate;

        return $this;
    }

    // Getter et Setter pour le statut
    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    // Getter et Setter pour le lien vers le dossier du drive
    public function getDriveLink(): ?string
    {
        return $this->driveLink;
    }

    public function setDriveLink(string $driveLink): static
    {
        $this->driveLink = $driveLink;

        return $this;
    }

    // Getter et Setter pour les photos (relation OneToMany)
    /**
     * @return Collection<int, Photo>
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): static
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setShooting($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): static
    {
        if ($this->photos->removeElement($photo)) {
            // mettre le côté propriétaire à null (à moins qu'il ait déjà été modifié)
            if ($photo->getShooting() === $this) {
                $photo->setShooting(null);
            }
        }

        return $this;
    }

    // Getter et Setter pour les notes
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }

    // Getter et Setter pour createdAt
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    // Getter et Setter pour updatedAt
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    // Callback lifecycle method pour update updatedAt à chaque mise à jour
    #[ORM\PreUpdate]
    public function updateUpdatedAt(): void
    {
        $this->updatedAt = new \DateTime();  // Met à jour la date de mise à jour avant la sauvegarde en base
    }
}
