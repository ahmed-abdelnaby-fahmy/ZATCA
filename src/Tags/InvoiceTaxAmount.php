<?php

namespace ZATCA\Tools\Tags;

use ZATCA\Tools\Tag;

class InvoiceTaxAmount extends Tag
{
    public function __construct($value)
    {
        parent::__construct(5, $value);
    }
}
