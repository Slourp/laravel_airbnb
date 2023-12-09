<?php

namespace Domain\Core\Housing\Entites;

use Domain\Core\Housing\Exceptions\InvalidCharacteristicsException;

class Caracteristiques
{
    public function __construct(
        public readonly int $nombreDeChambres,
        public readonly int $nombreDeSallesDeBain,
        public readonly bool $wifi,
        public readonly bool $parking
    ) {
    }

    public static function of(int $nombreDeChambres, int $nombreDeSallesDeBain, bool $wifi, bool $parking): self
    {
        if ($nombreDeChambres <= 0) {
            throw new InvalidCharacteristicsException('Invalid number of bedrooms provided.');
        }
        if ($nombreDeSallesDeBain <= 0) {
            throw new InvalidCharacteristicsException('Invalid number of bathrooms provided.');
        }

        return new self($nombreDeChambres, $nombreDeSallesDeBain, $wifi, $parking);
    }
}
