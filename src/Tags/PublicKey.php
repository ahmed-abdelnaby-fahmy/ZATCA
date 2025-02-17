<?php

namespace ZATCA\Tools\Tags;

use ZATCA\Tools\Tag;

class PublicKey extends Tag
{
    public function __construct($value)
    {
        parent::__construct(8, $value);
    }
}
