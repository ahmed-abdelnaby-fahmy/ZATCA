# 🚀 ZATCA Tools - QR Code & Invoice Signing
<p align="center">
  <h1 align="center">🧾 ZATCA (Fatoora) QR-Code & Invoice Signing</h1>
  <p align="center">
    A PHP library to generate QR codes and sign invoices for ZATCA e-invoicing compliance in Saudi Arabia.
    <br />
    <a href="https://github.com/ahmed-abdelnaby-fahmy/zatca-tools/issues/new">🐛 Report Bug</a> · 
    <a href="https://github.com/ahmed-abdelnaby-fahmy/zatca-tools/discussions/new">✨ Request Feature</a>
  </p>
</p>

---

## ✅ Requirements
- 🐘 **PHP** >= 8.0
- 🔡 `mbstring` extension
- 📜 `ext-dom` extension

---

## 📦 Installation
Install the package via Composer:

```bash
composer require ahmedabdelnaby/zatca-tools
```

<p align="right">(<a href="#top">⬆ Back to top</a>)</p>

---

## 🚀 Usage
This package supports both **Phase 1** and **Phase 2** of ZATCA compliance.

- **Phase 1:** 🔲 QR code generation.
- **Phase 2:** ✍️ Invoice signing & 🏢 System integration with ZATCA.

---

### 1️⃣ **Generating CSR (Certificate Signing Request)**
Before signing invoices, you need to generate a CSR and register your merchant in **ZATCA APIs**.

```php
use ZATCA\Tools\GenerateCSR;
use ZATCA\Tools\Models\CSRRequest;

$data = CSRRequest::make()
    ->setUID('string $OrganizationIdentifier')
    ->setSerialNumber('string $solutionName', 'string $version', 'string $serialNumber')
    ->setCommonName('string $commonName')
    ->setCountryName('SA')
    ->setOrganizationName('string $organizationName')
    ->setOrganizationalUnitName('string $organizationalUnitName')
    ->setRegisteredAddress('string $registeredAddress')
    ->setInvoiceType(true, true) // invoice types, default is true, true
    ->setCurrentZatcaEnv('sandbox') // Supports ['sandbox', 'simulation', 'core']
    ->setBusinessCategory('string $businessCategory');

$CSR = GenerateCSR::fromRequest($data)->initialize()->generate();

// Save 🔑 private key
openssl_pkey_export_to_file($CSR->getPrivateKey(), 'private-key.pem');

// Save 📝 CSR content
file_put_contents('csr.pem', $CSR->getCsrContent());
```
🔹 **Now, submit the CSR to ZATCA APIs to receive your certificate.**

---

### 2️⃣ **Signing Invoices & Generating QR Code**
After receiving a certificate from ZATCA, you can **sign invoices** and **generate QR codes**.

```php
use ZATCA\Tools\Helpers\Certificate;
use ZATCA\Tools\Models\InvoiceSign;

$xmlInvoice = 'xml invoice text';

$certificate = (new Certificate(
    'certificate plain text (base64 decoded)', // 📜 Get from ZATCA
    'private key plain text' // 🔑 Generated in CSR step
))->setSecretKey('🔒 secret key text'); // 🔑 Get from ZATCA

$invoice = (new InvoiceSign($xmlInvoice, $certificate))->sign();

// Get invoice details 📄
$invoice->getHash();      // 🏷️ Invoice Hash
$invoice->getInvoice();   // 📝 Signed XML Invoice
$invoice->getQRCode();    // 🔲 QR Code in Base64 format
```

---

### 3️⃣ **Generating QR Code from Invoice Data**
```php
use ZATCA\Tools\GenerateQrCode;
use ZATCA\Tools\Helpers\UXML;
use ZATCA\Tools\Helpers\Certificate;

$xmlInvoice = 'xml invoice text';

$certificate = (new Certificate(
    'certificate plain text (base64 decoded)',
    'private key plain text'
))->setSecretKey('secret key text');

$tags = UXML::fromString($xmlInvoice)->toTagsArray($certificate);

$QRCodeAsBase64 = GenerateQrCode::fromArray($tags)->toBase64();
```

---

### 4️⃣ **Generating Basic QR Code (Phase 1)**
```php
use ZATCA\Tools\GenerateQrCode;
use ZATCA\Tools\Tags\InvoiceDate;
use ZATCA\Tools\Tags\InvoiceTaxAmount;
use ZATCA\Tools\Tags\InvoiceTotalAmount;
use ZATCA\Tools\Tags\Seller;
use ZATCA\Tools\Tags\TaxNumber;

$generatedString = GenerateQrCode::fromArray([
    new Seller('Company Name'),
    new TaxNumber('1234567891'),
    new InvoiceDate('2024-02-17T14:25:09Z'),
    new InvoiceTotalAmount('500.00'),
    new InvoiceTaxAmount('75.00')
])->toBase64();
```

---

### 5️⃣ **Display QR Code in HTML**
```php
$displayQRCodeAsBase64 = GenerateQrCode::fromArray([
    new Seller('Company Name'),
    new TaxNumber('1234567891'),
    new InvoiceDate('2024-02-17T14:25:09Z'),
    new InvoiceTotalAmount('500.00'),
    new InvoiceTaxAmount('75.00')
])->render();
```
Now, use it in an `<img>` tag:
```html
<img src="<?php echo $displayQRCodeAsBase64; ?>" alt="Invoice QR Code" />
```

<p align="right">(<a href="#top">⬆ Back to top</a>)</p>

---

## 🔎 Reading the QR Code
The QR code follows **ZATCA's TLV format**, making it unreadable by normal scanners.  
To check your QR code, use this **online scanner**:  
🔗 [📸 Online QR Code Reader](https://www.onlinebarcodereader.com/)

---

## 🧪 Running Tests
Run the tests using:
```bash
composer test
```


## 🔒 Security
If you discover security vulnerabilities, **please do not open an issue**. Instead, email:  
📧 `ahmedabdelnabyfahmy1@gmail.com`


