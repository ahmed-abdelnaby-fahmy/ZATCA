<?php

namespace ZATCA\Tools\Tags;

use ZATCA\Tools\Tag;

class Seller extends Tag
{
    public function __construct($value)
    {
        parent::__construct(1, $value);
    }
}
