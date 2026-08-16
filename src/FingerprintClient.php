<?php

namespace Fingerprintphp;

use Fingerprintphp\Storage\FileStorage;
use Fingerprintphp\Storage\StorageInterface;

class FingerprintClient
{
    const CDN_URL = 'https://openfpcdn.io/fingerprintjs/v5';
    const VERSION = '5';

    protected StorageInterface $storage;
    protected ?string $endpointUrl;

    public function __construct(array $options = [])
    {
        $this->storage = $options['storage'] ?? new FileStorage();
        $this->endpointUrl = $options['endpointUrl'] ?? null;
    }

    public function getJavaScript(array $options = []): string
    {
        $endpoint = $options['endpoint'] ?? $this->endpointUrl;
        $autoSend = $options['autoSend'] ?? true;
        $debug = $options['debug'] ?? false;
        $callback = $options['callback'] ?? 'null';

        $script = <<<JS
<script>
(function() {
    const fpPromise = import('{$this->getCdnUrl()}')
        .then(FingerprintJS => FingerprintJS.load());

    fpPromise
        .then(fp => fp.get())
        .then(result => {
            const data = {
                visitorId: result.visitorId,
                requestId: result.requestId || null,
                confidence: result.confidence?.score || null,
                components: {}
            };

            for (const [key, component] of Object.entries(result.components)) {
                data.components[key] = component.value;
            }

JS;

        if ($autoSend && $endpoint) {
            $script .= <<<JS

            fetch('{$endpoint}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(serverResult => {
                if ({$callback}) {
                    {$callback}(serverResult, data);
                }
            })
            .catch(error => {
                console.error('Fingerprint send error:', error);
            });

JS;
        } else {
            $script .= <<<JS

            if ({$callback}) {
                {$callback}(null, data);
            }

JS;
        }

        if ($debug) {
            $script .= <<<JS

            console.log('Fingerprint:', data);

JS;
        }

        $script .= <<<JS
        })
        .catch(error => {
            console.error('Fingerprint error:', error);
        });
})();
</script>
JS;

        return $script;
    }

    public function handleRequest(?array $data = null): FingerprintData
    {
        if ($data === null) {
            $input = file_get_contents('php://input');
            $data = json_decode($input, true);
        }

        if (!$data || !isset($data['visitorId'])) {
            throw new FingerprintException('Invalid fingerprint data');
        }

        $components = $data['components'] ?? [];

        $fingerprintData = new FingerprintData([
            'visitorId' => $data['visitorId'],
            'requestId' => $data['requestId'] ?? null,
            'confidence' => $data['confidence'] ?? null,
            'applePay' => $components['applePay'] ?? null,
            'architecture' => $components['architecture'] ?? null,
            'audio' => $components['audio'] ?? null,
            'audioBaseLatency' => $components['audioBaseLatency'] ?? null,
            'canvas' => is_array($components['canvas'] ?? null) ? json_encode($components['canvas']) : ($components['canvas'] ?? null),
            'colorDepth' => $components['colorDepth'] ?? null,
            'colorGamut' => $components['colorGamut'] ?? null,
            'contrast' => $components['contrast'] ?? null,
            'cookiesEnabled' => $components['cookiesEnabled'] ?? null,
            'cpuClass' => $components['cpuClass'] ?? null,
            'dateTimeLocale' => $components['dateTimeLocale'] ?? null,
            'deviceMemory' => $components['deviceMemory'] ?? null,
            'domBlockers' => $components['domBlockers'] ?? null,
            'fontPreferences' => $components['fontPreferences'] ?? null,
            'fonts' => $components['fonts'] ?? null,
            'forcedColors' => $components['forcedColors'] ?? null,
            'hardwareConcurrency' => $components['hardwareConcurrency'] ?? null,
            'hdr' => $components['hdr'] ?? null,
            'indexedDb' => $components['indexedDb'] ?? null,
            'invertedColors' => $components['invertedColors'] ?? null,
            'languages' => $components['languages'] ?? null,
            'localStorage' => $components['localStorage'] ?? null,
            'math' => is_array($components['math'] ?? null) ? json_encode($components['math']) : ($components['math'] ?? null),
            'monochrome' => $components['monochrome'] ?? null,
            'openDatabase' => $components['openDatabase'] ?? null,
            'osCpu' => $components['osCpu'] ?? null,
            'pdfViewerEnabled' => $components['pdfViewerEnabled'] ?? null,
            'platform' => $components['platform'] ?? null,
            'plugins' => $components['plugins'] ?? null,
            'privateClickMeasurement' => $components['privateClickMeasurement'] ?? null,
            'reducedMotion' => $components['reducedMotion'] ?? null,
            'reducedTransparency' => $components['reducedTransparency'] ?? null,
            'screenFrame' => $components['screenFrame'] ?? null,
            'screenResolution' => $components['screenResolution'] ?? null,
            'sessionStorage' => $components['sessionStorage'] ?? null,
            'timezone' => $components['timezone'] ?? null,
            'touchSupport' => $components['touchSupport'] ?? null,
            'userAgentData' => $components['userAgentData'] ?? null,
            'vendor' => $components['vendor'] ?? null,
            'vendorFlavors' => $components['vendorFlavors'] ?? null,
            'webgl' => is_array($components['webgl'] ?? null) ? json_encode($components['webgl']) : ($components['webgl'] ?? null),
            'ip' => $this->getClientIp(),
            'userAgent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
            'createdAt' => time(),
        ]);

        $this->storage->save($fingerprintData);

        return $fingerprintData;
    }

    public function get(string $visitorId): ?FingerprintData
    {
        return $this->storage->get($visitorId);
    }

    public function getByIp(?string $ip = null): ?FingerprintData
    {
        $ip = $ip ?? $this->getClientIp();
        return $this->storage->getByIp($ip);
    }

    public function exists(string $visitorId): bool
    {
        return $this->storage->exists($visitorId);
    }

    public function delete(string $visitorId): bool
    {
        return $this->storage->delete($visitorId);
    }

    public function all(): array
    {
        return $this->storage->all();
    }

    public function setStorage(StorageInterface $storage): self
    {
        $this->storage = $storage;
        return $this;
    }

    public function getStorage(): StorageInterface
    {
        return $this->storage;
    }

    public function getCdnUrl(): string
    {
        return self::CDN_URL;
    }

    protected function getClientIp(): ?string
    {
        $headers = [
            'HTTP_CF_CONNECTING_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR',
        ];

        foreach ($headers as $header) {
            if (!empty($_SERVER[$header])) {
                $ip = $_SERVER[$header];
                if (strpos($ip, ',') !== false) {
                    $ip = trim(explode(',', $ip)[0]);
                }
                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $ip;
                }
            }
        }

        return null;
    }

    public function jsonResponse(FingerprintData $data): void
    {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'visitorId' => $data->getVisitorId(),
            'data' => $data->toArray(),
        ]);
    }
}
