<?php
require_once(__DIR__ . '/bootstrap.php');

/**
 * JSONのチェック
 */
use JsonSchema\Validator;

$checkFiles = [EXPORT_PREF_JSON, EXPORT_CITIES_JSON, EXPORT_WARDS_JSON, EXPORT_FULL_JSON];

$schema = (object)['$ref' => 'file://' . realpath(__DIR__ . '/../schema.json')];
$validator = new Validator;

foreach ($checkFiles as $file) {
    $validator->reset();
    $data = json_decode(file_get_contents($file));
    $validator->validate($data, $schema);

    if (!$validator->isValid()) {
        echo sprintf("%s does not valid. Violations:\n", basename($file));
        foreach ($validator->getErrors() as $error) {
            echo sprintf("[%s] %s\n", $error['property'], $error['message']);
        }
    }
}
