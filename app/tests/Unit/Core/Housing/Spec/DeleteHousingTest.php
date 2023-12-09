<?php

use Tests\Unit\Core\Housing\Fixture\DeleteHousingFixture;
use Domain\Core\Housing\Exceptions\HousingNotFoundException;
use Application\Core\Housing\DeleteHousing\DeleteHousingInteractor;
use Application\Core\Housing\DeleteHousing\DeleteHousingRequest;
use Tests\Unit\Core\Housing\Repository\InMemoryHousingRepository;
use Domain\Core\Housing\Builder\HousingDtoBuilder;
use Ramsey\Uuid\Uuid;

beforeEach(function () {
    $repository = new InMemoryHousingRepository();
    $usecase = new DeleteHousingInteractor($repository);
    $this->fixture = new DeleteHousingFixture($repository, $usecase);
});

describe("Feature: Deleting a housing unit", function () {

    describe("Scenario: Correct Deletion", function () {
        it('can delete housing correctly', function () {

            $housingDto = (new HousingDtoBuilder())
                ->withId(Uuid::uuid4()->toString())
                ->withTitle('Condo Apartment')
                ->withDescription('A beautiful condo with scenic views')
                ->withAdresse([
                    'rue' => '123 Main Street',
                    'ville' => 'Anytown',
                    'codePostal' => '12345',
                    'pays' => 'Wonderland'
                ])
                ->withCaracteristiques([
                    'nombreDeChambres' => 3,
                    'nombreDeSallesDeBain' => 2,
                    'wifi' => true,
                    'parking' => true
                ])
                ->withPhotos(['photo1.jpg', 'photo2.jpg'])
                ->build();

            // Assume a housing exists
            $this->fixture->givenHousingExists($housingDto);

            $command = new DeleteHousingRequest(id: $housingDto->id);

            $this->fixture->whenHousingIsDeleted($command);

            $this->fixture->thenHousingShouldNotExist($housingDto->id);
        });
    });

    describe("Scenario: Incorrect Deletion - Nonexistent Housing", function () {
        it('throws an error when trying to delete nonexistent housing', function () {
            $command = new DeleteHousingRequest(
                id: 999 // Assuming this ID doesn't exist
            );

            $this->fixture->whenHousingIsDeleted($command);
            $this->fixture->thenErrorShouldBe(HousingNotFoundException::class);
        });
    });
});
