<?php
require __DIR__ . '/vendor/autoload.php';

$path = __DIR__ . '/public/firebase_credentials.json';
if (!file_exists($path)) {
    echo "ERROR: File public/firebase_credentials.json does not exist!\n";
    exit;
}

$json = json_decode(file_get_contents($path), true);
echo "Project ID: " . ($json['project_id'] ?? 'MISSING') . "\n";
echo "Client Email: " . ($json['client_email'] ?? 'MISSING') . "\n";

try {
    $client = new Google\Client();
    $client->setAuthConfig($path);
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $client->refreshTokenWithAssertion();
    echo "AUTH SUCCESS! Token generated successfully.\n";
} catch (Exception $e) {
    echo "AUTH ERROR: " . $e->getMessage() . "\n";
}
