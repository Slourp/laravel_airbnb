<?

namespace Domain\Core\Housing\ValueObject;

use Domain\Core\Housing\Exceptions\InvalidTitleException;

class Title
{

    private function __construct(public readonly string $value)
    {
    }

    public static function of($title): Title
    {
        if (empty(trim($title))) throw new InvalidTitleException();

        return new self($title);
    }
}
