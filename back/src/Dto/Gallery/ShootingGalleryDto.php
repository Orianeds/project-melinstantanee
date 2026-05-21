<?php

namespace App\Dto\Gallery;

class ShootingGalleryDto
{
    /**
     * @param PhotoDto[] $photos
     */
    public function __construct(
        public int $id,
        public string $slug,
        public string $title,
        public string $status,
        public ?string $coverPhotoUrl,
        public array $photos,
    ) {}
}