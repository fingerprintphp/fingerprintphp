# FingerprintPHP

PHP wrapper for the [FingerprintJS](https://github.com/nicebyte/fingerprintjs) browser fingerprinting library.

## Installation

```bash
composer require fingerprintphp/fingerprintphp
```

## Usage

### Generate JavaScript Snippet

```php
<?php

use Fingerprintphp\FingerprintClient;

$client = new FingerprintClient();

echo $client->getJavaScript([
    'endpoint' => '/your-endpoint.php',
    'autoSend' => true,
    'debug' => false,
    'callback' => 'onFingerprint',
]);
```

### Handle Fingerprint Data

```php
<?php

use Fingerprintphp\FingerprintClient;
use Fingerprintphp\Storage\FileStorage;

$client = new FingerprintClient([
    'storage' => new FileStorage('/path/to/storage'),
]);

$fingerprint = $client->handleRequest();
$client->jsonResponse($fingerprint);
```

### Lookup Fingerprint

```php
<?php

$fingerprint = $client->get($visitorId);

echo $fingerprint->getVisitorId();
echo $fingerprint->getIp();
echo $fingerprint->getPlatform();
echo $fingerprint->getTimezone();
echo $fingerprint->getVendor();
```

### Available Getters

| Method | Description |
|--------|-------------|
| `getVisitorId()` | Unique visitor identifier |
| `getConfidence()` | Confidence score |
| `getIp()` | Client IP address |
| `getUserAgent()` | User agent string |
| `getPlatform()` | OS platform |
| `getTimezone()` | Timezone |
| `getLanguages()` | Browser languages |
| `getScreenResolution()` | Screen resolution |
| `getColorDepth()` | Color depth |
| `getDeviceMemory()` | Device memory (GB) |
| `getHardwareConcurrency()` | CPU cores |
| `getCanvas()` | Canvas fingerprint |
| `getWebgl()` | WebGL fingerprint |
| `getAudio()` | Audio fingerprint |
| `getFonts()` | Installed fonts |
| `getPlugins()` | Browser plugins |
| `getCookiesEnabled()` | Cookies enabled |
| `getLocalStorage()` | LocalStorage available |
| `getSessionStorage()` | SessionStorage available |
| `getIndexedDb()` | IndexedDB available |
| `getTouchSupport()` | Touch support info |
| `getVendor()` | Browser vendor |
| `getArchitecture()` | CPU architecture |
| `getCreatedAt()` | Timestamp |

### Custom Storage

Implement `StorageInterface` for custom storage:

```php
<?php

use Fingerprintphp\Storage\StorageInterface;
use Fingerprintphp\FingerprintData;

class DatabaseStorage implements StorageInterface
{
    public function save(FingerprintData $data): bool
    {
        // Save to database
    }

    public function get(string $visitorId): ?FingerprintData
    {
        // Get from database
    }

    public function getByIp(string $ip): ?FingerprintData
    {
        // Get by IP
    }

    public function exists(string $visitorId): bool
    {
        // Check existence
    }

    public function delete(string $visitorId): bool
    {
        // Delete record
    }

    public function all(): array
    {
        // Get all records
    }
}
```

## License

MIT
