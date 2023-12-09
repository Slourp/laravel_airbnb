<?php

namespace Domain\Core\Housing\Repositories;

use Domain\Core\Housing\Dto\HousingDto;

interface HousingRepositoryInterface
{
    public function addHousing(HousingDto $housingData): bool;
    public function deleteHousing(string $housingId): bool;
    public function findById(string $id): ?HousingDto;
    public function findByAddress(string $address): ?HousingDto;
}
