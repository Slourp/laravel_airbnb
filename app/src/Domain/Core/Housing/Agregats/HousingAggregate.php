<?php

namespace Domain\Core\Housing\Agregats;

use Domain\Core\Housing\Entites\Photo;
use Domain\Core\Housing\Entites\Adresse;
use Domain\Core\Housing\ValueObject\Title;
use Domain\Core\Housing\Entites\Caracteristiques;
use Domain\Core\Housing\Exceptions\InvalidPhotosException;

class HousingAggregate
{
    private ?string $id;
    private Title $title;
    private string $description;
    private Adresse $adresse;
    private Caracteristiques $caracteristiques;
    private array $photos;

    public function __construct(
        string $title,
        string $description,
        array $adresseData,
        array $caracteristiquesData,
        array $photos,
        ?string $id = null
    ) {
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setAdresse($adresseData);
        $this->setCaracteristiques($caracteristiquesData);
        $this->setPhotos($photos);
        $this->id = $id;
    }

    private function setTitle(string $title): void
    {
        $this->title = Title::of($title);
    }

    private function setDescription(string $description): void
    {
        $this->description = $description;
    }

    private function setAdresse(array $adresseData): void
    {
        $this->adresse = Adresse::of(
            rue: $adresseData['rue'],
            ville: $adresseData['ville'],
            codePostal: $adresseData['codePostal'],
            pays: $adresseData['pays']
        );
    }

    private function setCaracteristiques(array $caracteristiquesData): void
    {
        $this->caracteristiques = Caracteristiques::of(
            nombreDeChambres: $caracteristiquesData['nombreDeChambres'],
            nombreDeSallesDeBain: $caracteristiquesData['nombreDeSallesDeBain'],
            wifi: $caracteristiquesData['wifi'],
            parking: $caracteristiquesData['parking']
        );
    }

    private function setPhotos(array $photos): void
    {
        if (empty($photos)) throw new InvalidPhotosException('At least one photo is required.');


        $this->photos = array_map(fn ($url) => Photo::of(url: $url), $photos);
    }

    public function updateTitle(string $newTitle): void
    {
        $this->title = Title::of(title: $newTitle);
    }

    // Method to update the description
    public function updateDescription(string $newDescription): void
    {
        $this->description = $newDescription;
    }

    // Method to update the address
    public function updateAdresse(array $newAdresseData): void
    {
        $this->adresse = Adresse::of(
            rue: $newAdresseData['rue'],
            ville: $newAdresseData['ville'],
            codePostal: $newAdresseData['codePostal'],
            pays: $newAdresseData['pays']
        );
    }

    // Method to update characteristics
    public function updateCaracteristiques(array $newCaracteristiquesData): void
    {
        $this->caracteristiques = Caracteristiques::of(
            nombreDeChambres: $newCaracteristiquesData['nombreDeChambres'],
            nombreDeSallesDeBain: $newCaracteristiquesData['nombreDeSallesDeBain'],
            wifi: $newCaracteristiquesData['wifi'],
            parking: $newCaracteristiquesData['parking']
        );
    }

    // Method to add a photo
    public function addPhoto(string $photoUrl): void
    {
        $this->photos[] = Photo::of($photoUrl);
    }

    public function removePhoto(string $photoUrl): void
    {
        $tempPhotos = array_filter($this->photos, fn ($photo) => $photo->getUrl() !== $photoUrl);

        if (empty($tempPhotos)) {
            throw new InvalidPhotosException('At least one photo is required. Cannot remove the last photo.');
        }

        $this->photos = $tempPhotos;
    }


    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title->value;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAdresse(): Adresse
    {
        return $this->adresse;
    }

    public function getCaracteristiques(): Caracteristiques
    {
        return $this->caracteristiques;
    }

    public function getPhotos(): array
    {
        return array_map(fn (Photo $photo) => $photo->url, $this->photos);
    }
}
