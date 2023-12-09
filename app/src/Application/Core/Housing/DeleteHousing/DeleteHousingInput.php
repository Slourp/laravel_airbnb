<?

namespace Application\Core\Housing\DeleteHousing;

interface DeleteHousingInput
{
    public function deleteHousing(DeleteHousingRequest $request): DeleteHousingResponseModel;
}
