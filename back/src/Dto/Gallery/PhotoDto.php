<?php

namespace App\Dto\Gallery;

class PhotoDto
{
    public function __construct(
        public int $id,
        public string $imageUrl,
    ) {}
}