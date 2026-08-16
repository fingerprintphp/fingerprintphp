<?php

namespace Fingerprintphp\Storage;

use Fingerprintphp\FingerprintData;

interface StorageInterface
{
    public function save(FingerprintData $data): bool;

    public function get(string $visitorId): ?FingerprintData;

    public function getByIp(string $ip): ?FingerprintData;

    public function exists(string $visitorId): bool;

    public function delete(string $visitorId): bool;

    public function all(): array;
}
