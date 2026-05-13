<?php

require_once "vendor/autoload.php";

$json = json_encode([
    'name' => [
        'first' => 'Mike',
        'last' => 'X',
    ],
    'address' => [
        'street' => '1600 Pennsylvania Avenue NW',
        'city' => 'Washington',
        'state' => 'DC',
        'zip' => '20500',
    ],
    'email' => 'mike@example.com',
]);

$cache = new Symfony\Component\Cache\Adapter\ArrayAdapter;

// POST Person
$request = new \Bitty\Http\ServerRequest(
    method:  'POST',
    uri:     '/person',
    body:    $json,
    headers: ['Content-Type' => 'application/json'],
);
$controller = new POC\Controllers\PersonController($request, $cache);
$controller->dispatch('personPost');

// GET Person
$request = new \Bitty\Http\ServerRequest(
    method:  'GET',
    uri:     '/person/1',
    headers: ['Content-Type' => 'application/json'],
);
$controller = new POC\Controllers\PersonController($request, $cache);
$response = $controller->dispatch('personGet');

echo "\nResponse to GET person\n";
$response->getBody()->rewind();
print_r($response->getBody()->getContents());

// PUT Person
$request = new \Bitty\Http\ServerRequest(
    method:  'PUT',
    uri:     '/person/1',
    body:    $json,
    headers: ['Content-Type' => 'application/json'],
);
$controller = new POC\Controllers\PersonController($request, $cache);
$response = $controller->dispatch('personPut');

echo "\nResponse to PUT person\n";
$response->getBody()->rewind();
print_r($response->getBody()->getContents());

/**** Follow up links

Validate Cypress tests against the OpenAPI
https://github.com/jc21/cypress-swagger-validation

Generate a TypeScript client
https://openapi-generator.tech/

docker run --rm \
    -v $PWD:/local openapitools/openapi-generator-cli generate \
    -i /local/poc.yaml \
    -g typescript \
    -o /local/out/typescript

Amazon API Gateway
https://docs.aws.amazon.com/apigateway/latest/developerguide/api-gateway-import-api.html
https://docs.aws.amazon.com/apigateway/latest/developerguide/http-api-open-api.html

*****/
