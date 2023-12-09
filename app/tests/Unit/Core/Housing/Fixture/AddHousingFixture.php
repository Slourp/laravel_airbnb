<?php

namespace Tests\Unit\Core\Housing\Fixture;

use Domain\Core\Housing\Dto\HousingDto;
use Application\Core\Housing\AddHousing\AddHousingInteractor;
use Application\Core\Housing\AddHousing\AddHousingRequestModel;
use Tests\Unit\Core\Housing\Repository\InMemoryHousingRepository;

class AddHousingFixture
{
    private ?\Exception $error = null;

    public function __construct(
        private InMemoryHousingRepository $repository,
        private AddHousingInteractor $addHousingInteractor
    ) {
    }
    public function whenHousingIsAdded(AddHousingRequestModel $request): void
    {
        try {
            $this->addHousingInteractor->addHousing($request);
        } catch (\Throwable $e) {
            $this->error = $e;
        }
    }

    public function thenErrorShouldBe(string $expectedError): void
    {
        expect(get_class($this->error))->toBe($expectedError);
    }

    public function thenHousingShouldBeAdded(string $address): void
    {
        /**
         * @var HousingDto|null $housin
         */
        $housing = $this->repository->findByAddress($address);

        expect($housing->adresse->rue)->toBe($address, "The added housing's address does not match the expected value");
    }
}
