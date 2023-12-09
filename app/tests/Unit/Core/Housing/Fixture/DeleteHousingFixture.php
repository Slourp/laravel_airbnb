<?php

namespace Tests\Unit\Core\Housing\Fixture;

use Domain\Core\Housing\Dto\HousingDto;
use Application\Core\Housing\DeleteHousing\DeleteHousingRequest;
use Tests\Unit\Core\Housing\Repository\InMemoryHousingRepository;
use Application\Core\Housing\DeleteHousing\DeleteHousingInteractor;

class DeleteHousingFixture
{
    private ?\Exception $error = null;

    public function __construct(
        private InMemoryHousingRepository $repository,
        private DeleteHousingInteractor $deleteHousingInteractor
    ) {
    }

    public function givenHousingExists(HousingDto $housing): void
    {
        $this->repository->addHousing($housing);
    }

    public function whenHousingIsDeleted(DeleteHousingRequest $request): void
    {
        try {
            $this->deleteHousingInteractor->deleteHousing($request);
        } catch (\Throwable $e) {
            $this->error = $e;
        }
    }

    public function thenErrorShouldBe(string $expectedError): void
    {
        expect(get_class($this->error))->toBe($expectedError);
    }

    public function thenHousingShouldNotExist(string $id): void
    {
        $housing = $this->repository->findById($id);
        expect($housing)->toBeNull("The housing with id $id should not exist");
    }
}
