<?php

namespace Application\Core\Housing\AddHousing;

use Domain\Core\Housing\Dto\HousingDto;

class AddHousingResponseModel
{
    public function __construct(
        public readonly string $status,
        public readonly string $message,
        public readonly ?HousingDto $housing = null
    ) {
    }
}
