<?php

namespace App\Dto\Gallery;

class PaginatedPhotosDto
{
    /**
     * @param PhotoDto[] $data
     */
    public function __construct(
        public array $data,
        public int $page,
        public int $limit,
        public int $total
    ) {}
}