<?

namespace Application\Core\Housing\AddHousing;

use Domain\Core\Housing\Agregats\HousingAggregate;
use Domain\Core\Housing\Builder\HousingDtoBuilder;
use Domain\Core\Housing\Repositories\HousingRepositoryInterface;

class AddHousingInteractor implements AddHousingInput
{
    public function __construct(private HousingRepositoryInterface $housingRepository)
    {
    }

    public function addHousing(AddHousingRequestModel $request): AddHousingResponseModel
    {
        $housingAggregate = new HousingAggregate(
            title: $request->title,
            description: $request->description,
            adresseData: [
                'rue' => $request->rue,
                'ville' => $request->ville,
                'codePostal' => $request->codePostal,
                'pays' => $request->pays
            ],
            caracteristiquesData: [
                'nombreDeChambres' => $request->nombreDeChambres,
                'nombreDeSallesDeBain' => $request->nombreDeSallesDeBain,
                'wifi' => $request->wifi,
                'parking' => $request->parking
            ],
            photos: $request->photos
        );

        $housingDto = (new HousingDtoBuilder())
            ->withTitle($housingAggregate->getTitle())
            ->withDescription($housingAggregate->getDescription())
            ->withAdresse([
                'rue' => $housingAggregate->getAdresse()->rue,
                'ville' => $housingAggregate->getAdresse()->ville,
                'codePostal' => $housingAggregate->getAdresse()->codePostal,
                'pays' => $housingAggregate->getAdresse()->pays
            ])
            ->withCaracteristiques([
                'nombreDeChambres' => $housingAggregate->getCaracteristiques()->nombreDeChambres,
                'nombreDeSallesDeBain' => $housingAggregate->getCaracteristiques()->nombreDeSallesDeBain,
                'wifi' => $housingAggregate->getCaracteristiques()->wifi,
                'parking' => $housingAggregate->getCaracteristiques()->parking
            ])
            ->withPhotos($housingAggregate->getPhotos())
            ->build();

        $saveHousingResponse = $this->housingRepository->addHousing($housingDto);

        if (!$saveHousingResponse) return new AddHousingResponseModel('failure', 'Failed to add housing.');

        return new AddHousingResponseModel('success', 'Housing has been added successfully.', $housingDto);
    }
}
