<?php

namespace ZATCA\Tools\Tags;

use ZATCA\Tools\Tag;

class InvoiceDate extends Tag
{
    public function __construct($value)
    {
        parent::__construct(3, $value);
    }
}
