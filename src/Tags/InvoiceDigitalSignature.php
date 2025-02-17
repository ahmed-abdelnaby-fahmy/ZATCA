<?php

namespace ZATCA\Tools\Tags;

use ZATCA\Tools\Tag;

class InvoiceDigitalSignature extends Tag
{
    public function __construct($value)
    {
        parent::__construct(7, $value);
    }
}
