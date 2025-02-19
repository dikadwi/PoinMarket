<?php

require 'vendor/autoload.php';

use OpenApi\Annotations as OA;
use OpenApi\Generator;

// Generate Swagger documentation for PHP/CodeIgniter
$openapi = Generator::scan([__DIR__ . '/../app/Controllers']);
file_put_contents(__DIR__ . '/../public/docs/swagger.json', $openapi->toJson());

// Execute Python documentation generation
exec('cd ../ai_service && python -m flask swagger export --output ../public/docs/ai_swagger.json');

// Merge both documentations
$php_docs = json_decode(file_get_contents(__DIR__ . '/../public/docs/swagger.json'), true);
$python_docs = json_decode(file_get_contents(__DIR__ . '/../public/docs/ai_swagger.json'), true);

// Merge paths and components
$merged_docs = array_merge_recursive($php_docs, $python_docs);

// Save merged documentation
file_put_contents(
    __DIR__ . '/../public/docs/complete_api_docs.json',
    json_encode($merged_docs, JSON_PRETTY_PRINT)
);
