<?php

namespace Domain\Core\Housing\Entites;

class Housing
{

    public function __construct(
        private int $id,
        private string $title,
        private string $description,
        private Adresse $adresse,
        private Caracteristiques $caracteristiques,
        private array $photos
    ) {
    }

    public function addPhoto(Photo $photo): void
    {
        $this->photos[] = $photo;
    }
    public function getPhotos(): array
    {
        return $this->photos;
    }
}
