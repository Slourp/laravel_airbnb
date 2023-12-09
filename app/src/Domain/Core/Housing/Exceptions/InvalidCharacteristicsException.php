<?php

namespace Domain\Core\Housing\Exceptions;

use Exception;

class InvalidCharacteristicsException extends Exception
{
    public function __construct(string $message = "Invalid characteristics value provided.")
    {
        parent::__construct($message);
    }
}
