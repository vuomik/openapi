<?php

namespace POC\Controllers;

use Bitty\Http\JsonResponse;
use League\OpenAPIValidation\PSR7\OperationAddress;
use League\OpenAPIValidation\PSR7\PathFinder;
use League\OpenAPIValidation\PSR7\ValidatorBuilder;
use League\OpenAPIValidation\Schema\TypeFormats\FormatsContainer;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Controller
{
    protected OperationAddress $operationAddress;

    protected ValidatorBuilder $validator;

    public function __construct(
        protected ServerRequestInterface $request,
        protected CacheItemPoolInterface $cache,
    ) {
        // These would go in some sort of bootstrapper
        FormatsContainer::registerFormat('string', 'us-state', function ($value): bool {
            return in_array($value, ['NJ', 'NY']);
        });

        FormatsContainer::registerFormat('string', 'us-zip', function ($value): bool {
            return ctype_digit(strval($value)) && strlen($value) === 5;
        });

        // Make sure this file is up-to-date:
        // vendor/bin/openapi src -o poc.yaml 
        $yaml = 'poc.yaml';
        $this->validator = (new ValidatorBuilder)->fromYamlFile($yaml)->setCache($this->cache);
    }

    public function dispatch(string $method): ResponseInterface
    {
        $this->validateRequest();
        $response = call_user_func([$this, $method]);
        $this->validateResponse($response);
        return $response;
    }

    protected function validateRequest(): void
    {
        $this->operationAddress = $this->validator->getServerRequestValidator()->validate($this->request);
    }

    protected function validateResponse(ResponseInterface $response): void
    {
        $this->validator->getResponseValidator()->validate($this->operationAddress, $response);
    }

    protected function getRequestBody(): object
    {
        return json_decode($this->request->getBody());
    }

    protected function makeResponse(object $response, int $httpCode = 200, array $headers = []): ResponseInterface
    {
        return new JsonResponse(
            body:       $response,
            statusCode: $httpCode,
            headers:    $headers,
        );
    }
}
