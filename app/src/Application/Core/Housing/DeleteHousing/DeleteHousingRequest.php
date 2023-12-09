<?php

namespace Application\Core\Housing\DeleteHousing;

class DeleteHousingRequest
{
    public function __construct(public readonly string $id)
    {
    }
}
