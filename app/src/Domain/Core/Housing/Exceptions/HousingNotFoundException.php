<?php

namespace Domain\Core\Housing\Exceptions;

use Exception;

class HousingNotFoundException extends Exception
{
    public function __construct($message = "Housing not found")
    {
        parent::__construct($message);
    }
}
