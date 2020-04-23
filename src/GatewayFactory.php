<?php

namespace Demokn\CloudPrinter;

use Demokn\CloudPrinter\Exception\RuntimeException;
use Demokn\CloudPrinter\Gateway\GatewayInterface;
use Demokn\CloudPrinter\Http\ClientInterface;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class GatewayFactory
{
    public function create(string $class, ClientInterface $httpClient = null, HttpRequest $httpRequest = null): GatewayInterface
    {
        $class = $this->getGatewayClassName($class);

        if (!class_exists($class)) {
            throw new RuntimeException("Class '$class' not found");
        }

        return new $class($httpClient, $httpRequest);
    }

    protected function getGatewayClassName(string $name): string
    {
        if (class_exists($name)) {
            return $name;
        }

        $name = Helper::studlyCase($name);

        return __NAMESPACE__.'\\Gateway\\'.$name.'Gateway';
    }
}
