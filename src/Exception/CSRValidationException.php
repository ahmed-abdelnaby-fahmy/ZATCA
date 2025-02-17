<?php

namespace ZATCA\Tools\Exception;

class CSRValidationException extends \Exception
{

    public function __construct(string $message, int $code)
    {
        parent::__construct('The given data was invalid::' . $message, $code);
    }

}
