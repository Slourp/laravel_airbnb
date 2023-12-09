<?

namespace Domain\Core\Housing\Builder;

use Domain\Core\Housing\Dto\HousingDto;
use Domain\Core\Housing\Entites\Adresse;
use Domain\Core\Housing\Entites\Caracteristiques;
use Domain\Core\Housing\Entites\Photo;
use Domain\Core\Housing\ValueObject\Title;

class HousingDtoBuilder
{
    private array $photos = [];
    private ?string $id = null;
    private ?Title $title = null;
    private ?string $description = null;
    private ?Adresse $adresse = null;
    private ?Caracteristiques $caracteristiques = null;

    public function withId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function withTitle(string $title): self
    {
        $this->title = Title::of($title);
        return $this;
    }

    public function withDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function withAdresse(array $adresseData): self
    {
        $this->adresse = Adresse::of(
            rue: $adresseData['rue'],
            ville: $adresseData['ville'],
            codePostal: $adresseData['codePostal'],
            pays: $adresseData['pays']
        );

        return $this;
    }
    public function withCaracteristiques(array $caracteristiquesData): self
    {
        $this->caracteristiques = Caracteristiques::of(
            nombreDeChambres: $caracteristiquesData['nombreDeChambres'],
            nombreDeSallesDeBain: $caracteristiquesData['nombreDeSallesDeBain'],
            wifi: $caracteristiquesData['wifi'],
            parking: $caracteristiquesData['parking']
        );

        return $this;
    }


    public function withPhotos(array $photos): self
    {
        $this->photos = array_map(fn ($url) => Photo::of($url), $photos);
        return $this;
    }
    public function fromArray(array $array): self
    {
        return $this
            ->withId($array['id'] ?? null)
            ->withTitle($array['title'] ?? null)
            ->withDescription($array['description'] ?? null)
            ->withAdresse($array['adresse'] ?? [])
            ->withCaracteristiques($array['caracteristiques'] ?? [])
            ->withPhotos($array['photos'] ?? []);
    }

    public function build(): HousingDto
    {
        return new HousingDto(
            id: $this->id,
            adresse: $this->adresse,
            caracteristiques: $this->caracteristiques,
            description: $this->description,
            photos: $this->photos,
            title: $this->title
        );
    }
}
