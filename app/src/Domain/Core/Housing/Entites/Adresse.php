<?php

namespace Domain\Core\Housing\Entites;

use Domain\Core\Housing\Exceptions\InvalidAddressException;

class Adresse
{
    public function __construct(
        public readonly string $rue,
        public readonly string $ville,
        public readonly string $codePostal,
        public readonly string $pays
    ) {
    }

    public static function of(string $rue, string $ville, string $codePostal, string $pays): self
    {
        if (empty($rue)) {
            throw new InvalidAddressException('Invalid street name provided.');
        }
        if (empty($ville)) {
            throw new InvalidAddressException('Invalid city name provided.');
        }
        if (empty($codePostal)) {
            throw new InvalidAddressException('Invalid postal code provided.');
        }
        if (empty($pays)) {
            throw new InvalidAddressException('Invalid country name provided.');
        }

        return new self($rue, $ville, $codePostal, $pays);
    }
}
