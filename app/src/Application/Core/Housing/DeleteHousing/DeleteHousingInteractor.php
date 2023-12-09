<?php

namespace Application\Core\Housing\DeleteHousing;

use Domain\Core\Housing\Exceptions\HousingNotFoundException;
use Domain\Core\Housing\Repositories\HousingRepositoryInterface;

class DeleteHousingInteractor implements DeleteHousingInput
{
    public function __construct(private HousingRepositoryInterface $housingRepository)
    {
    }

    public function deleteHousing(DeleteHousingRequest $request): DeleteHousingResponseModel
    {

        if (is_null($this->housingRepository->findById($request->id))) {
            throw new HousingNotFoundException(sprintf('Housing with id %d not found', $request->id));
        }

        $this->housingRepository->deleteHousing($request->id);

        return new DeleteHousingResponseModel(sprintf('Housing with id %d deleted successfuly', $request->id), true);
    }
}
