<?

namespace Application\Core\Housing\DeleteHousing;

class DeleteHousingResponseModel
{
    public function __construct(
        public readonly string $status,
        public readonly string $message,
    ) {
    }
}
