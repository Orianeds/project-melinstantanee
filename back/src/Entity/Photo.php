<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PhotoRepository::class)]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * Identifiant unique du fichier dans Google Drive.
     *
     * Permet d'identifier une photo de manière fiable lors
     * des synchronisations et d'éviter les doublons.
     */
    #[ORM\Column(length: 255, unique: true)]
    private ?string $driveFileId = null;

    /**
     * Nom du fichier dans Google Drive.
     */
    #[ORM\Column(length: 255)]
    private ?string $driveFileName = null;

    /**
     * URL de la photo.
     */
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Url(message: 'L\'URL de la photo doit être valide')]
    private ?string $photoUrl = null;

    /**
     * URL de la miniature.
     */
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Url(message: 'L\'URL de la miniature doit être valide')]
    private ?string $thumbnailUrl = null;

    /**
     * Type MIME du fichier.
     *
     * Exemple : image/jpeg, image/png...
     */
    #[ORM\Column(length: 100, nullable: true)]
    private ?string $mimeType = null;

    /**
     * Date de création de l'enregistrement en base.
     */
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    /**
     * Date de dernière modification de l'enregistrement.
     */
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $updatedAt;

    /**
     * Description optionnelle de la photo.
     */
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(targetEntity: Shooting::class, inversedBy: 'photos')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Shooting $shooting = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function updateTimestamp(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    // =========================
    // GETTERS / SETTERS
    // =========================

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDriveFileId(): ?string
    {
        return $this->driveFileId;
    }

    public function setDriveFileId(string $driveFileId): static
    {
        $this->driveFileId = $driveFileId;

        return $this;
    }

    public function getDriveFileName(): ?string
    {
        return $this->driveFileName;
    }

    public function setDriveFileName(string $driveFileName): static
    {
        $this->driveFileName = $driveFileName;

        return $this;
    }

    public function getPhotoUrl(): ?string
    {
        return $this->photoUrl;
    }

    public function setPhotoUrl(?string $photoUrl): static
    {
        $this->photoUrl = $photoUrl;

        return $this;
    }

    public function getThumbnailUrl(): ?string
    {
        return $this->thumbnailUrl;
    }

    public function setThumbnailUrl(?string $thumbnailUrl): static
    {
        $this->thumbnailUrl = $thumbnailUrl;

        return $this;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function setMimeType(?string $mimeType): static
    {
        $this->mimeType = $mimeType;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getShooting(): ?Shooting
    {
        return $this->shooting;
    }

    public function setShooting(?Shooting $shooting): static
    {
        $this->shooting = $shooting;

        return $this;
    }
}