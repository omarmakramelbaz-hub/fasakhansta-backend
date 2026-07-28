<?php
$path = __DIR__ . '/public/firebase_credentials.json';
$json = json_decode(file_get_contents($path), true);
$pk = $json['private_key'] ?? '';

echo "Key length: " . strlen($pk) . "\n";
echo "Has BEGIN header: " . (strpos($pk, '-----BEGIN PRIVATE KEY-----') !== false ? 'YES' : 'NO') . "\n";
echo "Has END header: " . (strpos($pk, '-----END PRIVATE KEY-----') !== false ? 'YES' : 'NO') . "\n";

$res = openssl_pkey_get_private($pk);
if ($res === false) {
    echo "OpenSSL Parse Error: " . openssl_error_string() . "\n";
} else {
    echo "OpenSSL Parse Status: VALID KEY!\n";
}
