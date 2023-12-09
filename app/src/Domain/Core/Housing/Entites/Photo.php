<?php

namespace Domain\Core\Housing\Entites;

use Domain\Core\Housing\Exceptions\InvalidPhotosException;

class Photo
{
    public function __construct(
        public readonly string $url
    ) {
    }

    public static function of(string $url): self
    {
        if (empty($url)) throw new InvalidPhotosException('Invalid photo URL provided.');

        return new self($url);
    }
}
