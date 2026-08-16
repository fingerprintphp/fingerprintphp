<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Fingerprintphp\FingerprintClient;
use Fingerprintphp\Storage\FileStorage;

$client = new FingerprintClient([
    'storage' => new FileStorage(__DIR__ . '/storage'),
]);

try {
    $fingerprint = $client->handleRequest();
    $client->jsonResponse($fingerprint);
} catch (\Exception $e) {
    header('Content-Type: application/json');
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
    ]);
}
