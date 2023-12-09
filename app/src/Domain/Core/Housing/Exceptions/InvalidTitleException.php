<?php

namespace Domain\Core\Housing\Exceptions;

use Exception;

class InvalidTitleException extends Exception
{
    public function __construct()
    {
        parent::__construct("Invalid Title value provided.");
    }
}
