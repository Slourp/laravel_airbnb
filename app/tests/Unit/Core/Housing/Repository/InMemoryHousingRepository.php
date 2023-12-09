<?php

namespace Tests\Unit\Core\Housing\Repository;

use Domain\Core\Housing\Builder\HousingDtoBuilder;
use Ramsey\Uuid\Uuid;
use Domain\Core\Housing\Entites\Photo;
use Domain\Core\Housing\Dto\HousingDto;
use Domain\Core\Housing\Entites\Adresse;
use Domain\Core\Housing\Entites\Caracteristiques;
use Domain\Core\Housing\Repositories\HousingRepositoryInterface;

class InMemoryHousingRepository implements HousingRepositoryInterface
{
    /**
     * @var array[]
     */
    private array $housingUnits = [];

    public function addHousing(HousingDto $housing): bool
    {
        $uuid = $housing?->id ?? Uuid::uuid4()->toString();
        $housingData = $housing->toArray();
        $housingData['id'] = $uuid;

        $this->housingUnits[]  = [$uuid => $housingData];

        return true;
    }
    public function findByAddress(string $address): ?HousingDto
    {
        foreach ($this->housingUnits as $housingData) {
            foreach ($housingData as $housing) {
                if ($housing['adresse']['rue'] === $address) {
                    // Utilisation du HousingDtoBuilder pour construire l'objet HousingDto
                    return (new HousingDtoBuilder())
                        ->fromArray($housing)
                        ->build();
                }
            }
        }
        return null;
    }


    public function deleteHousing(string $housingId): bool
    {
        if (isset($this->housingUnits[$housingId])) {
            unset($this->housingUnits[$housingId]);
            return true;
        }
        return false;
    }

    public function findById(string $id): ?HousingDto
    {
        if (!isset($this->housingUnits[$id])) {
            return null;
        }

        $housingData = $this->housingUnits[$id];

        return (new HousingDtoBuilder())
            ->fromArray($housingData)
            ->build();
    }
}
