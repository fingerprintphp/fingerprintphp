# FingerprintPHP

Track visitors across sessions without cookies.

## Introduction

This package provides a PHP wrapper for browser fingerprinting. It collects 40+ browser signals to generate a unique visitor identifier that persists across sessions, incognito windows, and cleared cookies.

**[Read the full documentation](https://fingerprintphp.github.io/fingerprintphp/)**

## Installation

You can install the package via composer:

```bash
composer require fingerprintphp/fingerprintphp
```

## Quick Start

Generate the JavaScript snippet for your page:

```php
use Fingerprintphp\FingerprintClient;

$client = new FingerprintClient();

echo $client->getJavaScript([
    'endpoint' => '/fingerprint.php',
    'autoSend' => true,
]);
```

Handle incoming fingerprint data on your endpoint:

```php
use Fingerprintphp\FingerprintClient;
use Fingerprintphp\Storage\FileStorage;

$client = new FingerprintClient([
    'storage' => new FileStorage(__DIR__ . '/storage'),
]);

$fingerprint = $client->handleRequest();
$client->jsonResponse($fingerprint);
```

Look up a stored fingerprint by visitor ID:

```php
$fingerprint = $client->get($visitorId);

echo $fingerprint->getVisitorId();
echo $fingerprint->getPlatform();
echo $fingerprint->getCanvas();
echo $fingerprint->getWebgl();
echo $fingerprint->getFonts();
```

## Documentation

Full documentation is available at **[fingerprintphp.github.io/fingerprintphp](https://fingerprintphp.github.io/fingerprintphp/)**

- [Installation](https://fingerprintphp.github.io/fingerprintphp/getting-started/installation/)
- [Quick Start](https://fingerprintphp.github.io/fingerprintphp/getting-started/quickstart/)
- [API Reference](https://fingerprintphp.github.io/fingerprintphp/api/fingerprint-client/)
- [All 40+ Getters](https://fingerprintphp.github.io/fingerprintphp/api/fingerprint-data/)
- [Custom Storage](https://fingerprintphp.github.io/fingerprintphp/storage/custom-storage/)
- [Laravel Integration](https://fingerprintphp.github.io/fingerprintphp/guides/laravel/)

## License

MIT
