<?php

namespace Domain\Core\Housing\Exceptions;

use Exception;

class InvalidPhotosException extends Exception
{
    public function __construct($message = 'Invalid photos value provided.')
    {
        parent::__construct($message);
    }
}
