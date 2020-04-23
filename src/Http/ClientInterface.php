<?php

namespace Demokn\CloudPrinter\Http;

use Psr\Http\Message\ResponseInterface;

interface ClientInterface
{
    public function request($method, $uri, array $options = []): ResponseInterface;
}
