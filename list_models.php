<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$apiKey = $_ENV['GEMINI_API_KEY'];

if (!$apiKey) {
    echo "API Key not found in .env\n";
    exit(1);
}

// Try v1beta
$url = "https://generativelanguage.googleapis.com/v1beta/models?key={$apiKey}";

echo "Querying: $url\n";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Bypass SSL for local dev
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$data = json_decode($response, true);

if (!isset($data['models'])) {
    echo "No models found or error parsing JSON.\n";
    exit;
}

echo "Available generateContent models:\n";
foreach ($data['models'] as $model) {
    if (isset($model['supportedGenerationMethods']) && in_array('generateContent', $model['supportedGenerationMethods'])) {
        echo "- " . $model['name'] . "\n";
    }
}
