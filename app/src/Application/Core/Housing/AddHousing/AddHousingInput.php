<?

namespace Application\Core\Housing\AddHousing;

interface AddHousingInput
{
    public function addHousing(AddHousingRequestModel $request): AddHousingResponseModel;
}
