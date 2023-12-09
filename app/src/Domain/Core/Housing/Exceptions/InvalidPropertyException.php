<?php

namespace Domain\Core\Housing\Exceptions;

use Exception;

class InvalidPropertyException extends Exception
{
    public function __construct()
    {
        parent::__construct("Invalid property value provided.");
    }
}
