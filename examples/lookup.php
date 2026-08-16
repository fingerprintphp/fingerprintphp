<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Fingerprintphp\FingerprintClient;
use Fingerprintphp\Storage\FileStorage;

$client = new FingerprintClient([
    'storage' => new FileStorage(__DIR__ . '/storage'),
]);

$visitorId = $_GET['id'] ?? null;

if ($visitorId) {
    $fingerprint = $client->get($visitorId);

    if ($fingerprint) {
        echo "Visitor ID: " . $fingerprint->getVisitorId() . "\n";
        echo "IP: " . $fingerprint->getIp() . "\n";
        echo "Platform: " . $fingerprint->getPlatform() . "\n";
        echo "Timezone: " . $fingerprint->getTimezone() . "\n";
        echo "Languages: " . json_encode($fingerprint->getLanguages()) . "\n";
        echo "Screen: " . json_encode($fingerprint->getScreenResolution()) . "\n";
    } else {
        echo "Fingerprint not found.\n";
    }
} else {
    echo "All fingerprints:\n\n";
    foreach ($client->all() as $fp) {
        echo "- " . $fp->getVisitorId() . " (" . $fp->getIp() . ")\n";
    }
}
