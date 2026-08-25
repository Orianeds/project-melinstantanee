<?php

namespace App\Entity;

use App\Repository\ShootingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\String\Slugger\AsciiSlugger;

#[ORM\Entity(repositoryClass: ShootingRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Shooting
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'shootings')]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private ?User $client = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank]
    private \DateTimeInterface $shootingDate;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $slug = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank]
    #[Assert\Choice(
        choices: ['en cours', 'terminé', 'annulé'],
        message: 'Statut invalide.'
    )]
    private string $status = 'en cours';

    #[ORM\Column(length: 255, unique: true)]
    private ?string $galleryToken = null;

    /**
     * ID unique du dossier Google Drive
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $driveFolderId = null;

    /**
     * Nom du dossier Google Drive
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $driveFolderName = null;

    /**
     * URL miniature affichée côté front
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $coverPhotoUrl = null;

    /**
     * Permet à la photographe de publier ou masquer une galerie
     */
    #[ORM\Column]
    private bool $isPublished = false;

    #[ORM\OneToMany(
        mappedBy: 'shooting',
        targetEntity: Photo::class,
        orphanRemoval: true
    )]
    private Collection $photos;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $updatedAt;

    public function __construct()
    {
        $this->photos = new ArrayCollection();

        $this->galleryToken = bin2hex(random_bytes(32));

        $this->status = 'en cours';

        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function updateTimestamp(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    #[ORM\PrePersist]
    public function generateSlug(): void
    {
        if ($this->slug === null) {
            $slugger = new AsciiSlugger();

            $clientName = $this->client?->getName() ?? 'shooting';
            $date = $this->shootingDate?->format('Y-m-d') ?? time();

            $this->slug = strtolower(
                $slugger->slug($clientName . '-' . $date)
            );
        }
    }

    // =========================
    // GETTERS / SETTERS
    // =========================

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

    public function getShootingDate(): \DateTimeInterface
    {
        return $this->shootingDate;
    }

    public function setShootingDate(\DateTimeInterface $shootingDate): static
    {
        $this->shootingDate = $shootingDate;

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getGalleryToken(): ?string
    {
        return $this->galleryToken;
    }

    public function setGalleryToken(string $galleryToken): static
    {
        $this->galleryToken = $galleryToken;

        return $this;
    }

    public function getDriveFolderId(): ?string
    {
        return $this->driveFolderId;
    }

    public function setDriveFolderId(?string $driveFolderId): static
    {
        $this->driveFolderId = $driveFolderId;

        return $this;
    }

    public function getDriveFolderName(): ?string
    {
        return $this->driveFolderName;
    }

    public function setDriveFolderName(?string $driveFolderName): static
    {
        $this->driveFolderName = $driveFolderName;

        return $this;
    }

    public function getCoverPhotoUrl(): ?string
    {
        return $this->coverPhotoUrl;
    }

    public function setCoverPhotoUrl(?string $coverPhotoUrl): static
    {
        $this->coverPhotoUrl = $coverPhotoUrl;

        return $this;
    }

    public function isPublished(): bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): static
    {
        $this->isPublished = $isPublished;

        return $this;
    }

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
            if ($photo->getShooting() === $this) {
                $photo->setShooting(null);
            }
        }

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
