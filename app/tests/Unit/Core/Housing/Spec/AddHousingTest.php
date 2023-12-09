<?php

use Tests\Unit\Core\Housing\Fixture\AddHousingFixture;
use Domain\Core\Housing\Exceptions\InvalidTitleException;
use Domain\Core\Housing\Exceptions\InvalidPhotosException;
use Domain\Core\Housing\Exceptions\InvalidAddressException;
use Domain\Core\Housing\Exceptions\InvalidPropertyException;
use Application\Core\Housing\AddHousing\AddHousingInteractor;
use Application\Core\Housing\AddHousing\AddHousingRequestModel;
use Tests\Unit\Core\Housing\Repository\InMemoryHousingRepository;
use Domain\Core\Housing\Exceptions\InvalidCharacteristicsException;

beforeEach(function () {
    $repository = new InMemoryHousingRepository();
    $usecase = new AddHousingInteractor($repository);
    $this->fixture = new AddHousingFixture($repository, $usecase);
});

describe("Feature: Adding a new housing unit", function () {

    describe("Scenario: Correct Addition", function () {
        it('can add housing correctly', function () {
            $command = new AddHousingRequestModel(
                title: 'Condo Apartment',
                description: 'A beautiful condo with scenic views',
                rue: '123 Main Street',
                ville: 'Anytown',
                codePostal: '12345',
                pays: 'Wonderland',
                nombreDeChambres: 3,
                nombreDeSallesDeBain: 2,
                wifi: true,
                parking: true,
                photos: ['photo1.jpg', 'photo2.jpg']
            );

            $this->fixture->whenHousingIsAdded($command);
            $this->fixture->thenHousingShouldBeAdded('123 Main Street');
        });
    });

    describe("Scenario: Incorrect Addition - No Title", function () {
        it('throws an error when title is not provided', function () {
            $command = new AddHousingRequestModel(
                title: '',
                description: 'A beautiful condo with scenic views',
                rue: '123 Main Street',
                ville: 'Anytown',
                codePostal: '12345',
                pays: 'Wonderland',
                nombreDeChambres: 3,
                nombreDeSallesDeBain: 2,
                wifi: true,
                parking: true,
                photos: ['photo1.jpg', 'photo2.jpg']
            );

            $this->fixture->whenHousingIsAdded($command);
            $this->fixture->thenErrorShouldBe(InvalidTitleException::class);
        });
    });

    describe("Scenario: Incorrect Addition - Invalid Address", function () {
        it('throws an error when address components are invalid', function () {
            $command = new AddHousingRequestModel(
                title: 'Condo Apartment',
                description: 'A beautiful condo with scenic views',
                rue: '',
                ville: 'Anytown',
                codePostal: '12345',
                pays: 'Wonderland',
                nombreDeChambres: 3,
                nombreDeSallesDeBain: 2,
                wifi: true,
                parking: true,
                photos: ['photo1.jpg', 'photo2.jpg']
            );

            $this->fixture->whenHousingIsAdded($command);
            $this->fixture->thenErrorShouldBe(InvalidAddressException::class);
        });
    });


    describe("Scenario: Incorrect Addition - Invalid Characteristics", function () {
        it('throws an error when characteristics are invalid', function () {
            $command = new AddHousingRequestModel(
                title: 'Condo Apartment',
                description: 'A beautiful condo with scenic views',
                rue: '123 Main Street',
                ville: 'Anytown',
                codePostal: '12345',
                pays: 'Wonderland',
                nombreDeChambres: 0,
                nombreDeSallesDeBain: 0,
                wifi: false,
                parking: false,
                photos: ['photo1.jpg', 'photo2.jpg']
            );

            $this->fixture->whenHousingIsAdded($command);
            $this->fixture->thenErrorShouldBe(InvalidCharacteristicsException::class);
        });
    });


    describe("Scenario: Incorrect Addition - Invalid Photos", function () {
        it('throws an error when photos are invalid', function () {
            $command = new AddHousingRequestModel(
                title: 'Condo Apartment',
                description: 'A beautiful condo with scenic views',
                rue: '123 Main Street',
                ville: 'Anytown',
                codePostal: '12345',
                pays: 'Wonderland',
                nombreDeChambres: 3,
                nombreDeSallesDeBain: 2,
                wifi: true,
                parking: true,
                photos: [] // invalid photos
            );

            $this->fixture->whenHousingIsAdded($command);
            $this->fixture->thenErrorShouldBe(InvalidPhotosException::class);
        });
    });
});
