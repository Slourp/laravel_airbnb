<?php

namespace Application\Core\Housing\AddHousing;

class AddHousingRequestModel
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly string $rue,
        public readonly string $ville,
        public readonly string $codePostal,
        public readonly string $pays,
        public readonly int $nombreDeChambres,
        public readonly int $nombreDeSallesDeBain,
        public readonly bool $wifi,
        public readonly bool $parking,
        public readonly array $photos
    ) {
    }
}
