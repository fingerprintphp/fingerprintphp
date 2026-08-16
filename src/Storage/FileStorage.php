<?php

namespace Fingerprintphp\Storage;

use Fingerprintphp\FingerprintData;
use Fingerprintphp\FingerprintException;

class FileStorage implements StorageInterface
{
    protected string $storagePath;

    public function __construct(?string $storagePath = null)
    {
        $this->storagePath = $storagePath ?? sys_get_temp_dir() . '/fingerprints';

        if (!is_dir($this->storagePath)) {
            mkdir($this->storagePath, 0755, true);
        }
    }

    public function save(FingerprintData $data): bool
    {
        $visitorId = $data->getVisitorId();

        if (!$visitorId) {
            throw new FingerprintException('Visitor ID is required');
        }

        $filename = $this->getFilename($visitorId);

        return file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT)) !== false;
    }

    public function get(string $visitorId): ?FingerprintData
    {
        $filename = $this->getFilename($visitorId);

        if (!file_exists($filename)) {
            return null;
        }

        $content = file_get_contents($filename);
        $data = json_decode($content, true);

        if (!$data) {
            return null;
        }

        return new FingerprintData($data);
    }

    public function getByIp(string $ip): ?FingerprintData
    {
        foreach ($this->all() as $fingerprint) {
            if ($fingerprint->getIp() === $ip) {
                return $fingerprint;
            }
        }

        return null;
    }

    public function exists(string $visitorId): bool
    {
        return file_exists($this->getFilename($visitorId));
    }

    public function delete(string $visitorId): bool
    {
        $filename = $this->getFilename($visitorId);

        if (!file_exists($filename)) {
            return false;
        }

        return unlink($filename);
    }

    public function all(): array
    {
        $fingerprints = [];
        $files = glob($this->storagePath . '/*.json');

        foreach ($files as $file) {
            $content = file_get_contents($file);
            $data = json_decode($content, true);

            if ($data) {
                $fingerprints[] = new FingerprintData($data);
            }
        }

        return $fingerprints;
    }

    protected function getFilename(string $visitorId): string
    {
        return $this->storagePath . '/' . $visitorId . '.json';
    }
}
