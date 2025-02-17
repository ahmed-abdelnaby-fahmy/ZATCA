<?php

namespace ZATCA\Tools\Tags;

use ZATCA\Tools\Tag;

class InvoiceTotalAmount extends Tag
{
    public function __construct($value)
    {
        parent::__construct(4, $value);
    }
}
