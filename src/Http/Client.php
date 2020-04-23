<?php

namespace Demokn\CloudPrinter\Http;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use Psr\Http\Message\ResponseInterface;

class Client implements ClientInterface
{
    private $httpClient;

    public function __construct(GuzzleClientInterface $httpClient = null)
    {
        $this->httpClient = $httpClient ?: $this->getDefaultHttpClient();
    }

    protected function getDefaultHttpClient(): GuzzleClientInterface
    {
        return new GuzzleClient();
    }

    public function request($method, $uri, array $options = []): ResponseInterface
    {
        return $this->httpClient->request($method, $uri, $options);
    }
}
