<?php

namespace ZATCA\Tools\Tags;

use ZATCA\Tools\Tag;

class InvoiceHash extends Tag
{
    public function __construct($value)
    {
        parent::__construct(6, $value);
    }
}
