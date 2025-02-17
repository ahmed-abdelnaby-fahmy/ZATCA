<?php

namespace ZATCA\Tools\Models;

use ZATCA\Tools\Helpers\Certificate;

class Invoice
{
    protected $hash;

    protected $invoice;
    /**
     * @var string
     */
    private $qrCode;
    /**
     * @var \ZATCA\Tools\Helpers\Certificate
     */
    private $certificate;

    public function __construct(string $invoice, string $hash, string $qrCode, Certificate $certificate)
    {
        $this->invoice = $invoice;
        $this->hash = $hash;
        $this->qrCode = $qrCode;
        $this->certificate = $certificate;
    }


    public function getHash(): string
    {
        return $this->hash;
    }

    public function getInvoice(): string
    {
        return $this->invoice;
    }
    public function getEncodedSignedXml()
    {
        return base64_encode($this->invoice);
    }
    public function getQRCode(): string
    {
        return $this->qrCode;
    }

    public function getCertificate(): Certificate
    {
        return $this->certificate;
    }

}
