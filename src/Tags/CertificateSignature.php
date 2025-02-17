<?php

namespace ZATCA\Tools\Tags;

use ZATCA\Tools\Tag;

class CertificateSignature extends Tag
{
    public function __construct($value)
    {
        parent::__construct(9, $value);
    }
}
