<?php

namespace Demokn\CloudPrinter\Gateway;

use Demokn\CloudPrinter\Helper;
use Demokn\CloudPrinter\Http\Client;
use Demokn\CloudPrinter\Http\ClientInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

abstract class AbstractGateway implements GatewayInterface
{
    protected $parameters;

    protected $httpClient;

    protected $httpRequest;

    public function __construct(ClientInterface $httpClient = null, HttpRequest $httpRequest = null)
    {
        $this->httpClient = $httpClient ?: $this->getDefaultHttpClient();
        $this->httpRequest = $httpRequest ?: $this->getDefaultHttpRequest();
        $this->initialize();
    }

    protected function getDefaultHttpClient(): Client
    {
        return new Client();
    }

    protected function getDefaultHttpRequest(): HttpRequest
    {
        return HttpRequest::createFromGlobals();
    }

    public function initialize(array $parameters = [])
    {
        $this->parameters = new ParameterBag();

        // set default parameters
        foreach ($this->getDefaultParameters() as $key => $value) {
            if (is_array($value)) {
                $this->parameters->set($key, reset($value));
            } else {
                $this->parameters->set($key, $value);
            }
        }

        Helper::initialize($this, $parameters);

        return $this;
    }

    public function getDefaultParameters(): array
    {
        return [];
    }

    public function getParameters(): array
    {
        return $this->parameters->all();
    }

    public function getParameter($key)
    {
        return $this->parameters->get($key);
    }

    public function setParameter($key, $value)
    {
        $this->parameters->set($key, $value);

        return $this;
    }

    public function getTestMode()
    {
        return $this->getParameter('testMode');
    }

    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }
}
