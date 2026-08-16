<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Fingerprintphp\FingerprintClient;

$client = new FingerprintClient([
    'endpointUrl' => '/fingerprint-endpoint.php',
]);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Fingerprint Example</title>
</head>
<body>
    <h1>Fingerprint Example</h1>
    <p>Check console for fingerprint data.</p>
    <div id="result"></div>

    <?= $client->getJavaScript([
        'endpoint' => '/fingerprint-endpoint.php',
        'autoSend' => true,
        'debug' => true,
        'callback' => 'handleFingerprint',
    ]) ?>

    <script>
        function handleFingerprint(serverResult, fingerprintData) {
            document.getElementById('result').innerHTML =
                '<pre>' + JSON.stringify(fingerprintData, null, 2) + '</pre>';

            if (serverResult) {
                console.log('Server response:', serverResult);
            }
        }
    </script>
</body>
</html>
