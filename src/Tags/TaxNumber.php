<?php

namespace ZATCA\Tools\Tags;

use ZATCA\Tools\Tag;

class TaxNumber extends Tag
{
    public function __construct($value)
    {
        parent::__construct(2, $value);
    }
}
