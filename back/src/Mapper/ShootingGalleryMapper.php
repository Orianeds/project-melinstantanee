<?php

namespace App\Mapper;

use App\Entity\Shooting;
use App\Dto\Gallery\PhotoDto;
use App\Dto\Gallery\ShootingGalleryDto;

class ShootingGalleryMapper
{
    public function toDto(Shooting $shooting): ShootingGalleryDto
    {
        $photos = [];

        foreach ($shooting->getPhotos() as $photo) {
            $photos[] = new PhotoDto(
                $photo->getId(),
                $photo->getImageUrl()
            );
        }

        return new ShootingGalleryDto(
            $shooting->getId(),
            $shooting->getSlug(),
            $shooting->getDriveFolderName() ?? 'Galerie',
            $shooting->getStatus(),
            $shooting->getCoverPhotoUrl(),
            $photos
        );
    }
}