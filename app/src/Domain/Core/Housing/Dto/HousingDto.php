<?php

namespace Domain\Core\Housing\Dto;

use Domain\Core\Housing\Entites\Adresse;
use Domain\Core\Housing\Entites\Caracteristiques;
use Domain\Core\Housing\Entites\Photo;
use Domain\Core\Housing\ValueObject\Title;

class HousingDto
{
    public function __construct(
        public readonly Title           $title,
        public readonly string           $description,
        public readonly Adresse          $adresse,
        public readonly Caracteristiques $caracteristiques,
        public readonly array            $photos,
        public readonly ?string          $id = null
    ) {
    }
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title->value, // Assumant que Title est un Value Object
            'description' => $this->description,
            'adresse' => [
                'rue' => $this->adresse->rue,
                'ville' => $this->adresse->ville,
                'codePostal' => $this->adresse->codePostal,
                'pays' => $this->adresse->pays
            ],
            'caracteristiques' => [
                'nombreDeChambres' => $this->caracteristiques->nombreDeChambres,
                'nombreDeSallesDeBain' => $this->caracteristiques->nombreDeSallesDeBain,
                'wifi' => $this->caracteristiques->wifi,
                'parking' => $this->caracteristiques->parking
            ],
            'photos' => array_map(fn (Photo $photo) => $photo->url, $this->photos)
        ];
    }
}
