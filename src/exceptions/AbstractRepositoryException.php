<?php

namespace Plopster\AbstractRepository\Exceptions;

use Exception;

class AbstractRepositoryException extends Exception
{
    public function __construct($details, $code = 0, Exception $previous = null)
    {
        parent::__construct($details, $code, $previous);
    }
}
