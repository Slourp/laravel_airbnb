<?php

namespace Domain\Core\Housing\Exceptions;

use Exception;

class InvalidAddressException extends Exception
{
    public function __construct($message = "Invalid address value provided.")
    {
        parent::__construct($message);
    }
}
