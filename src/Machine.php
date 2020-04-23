<?php

namespace Demokn\CloudPrinter;

use Symfony\Component\HttpFoundation\ParameterBag;

class Machine
{
    protected $parameters;

    public function __construct(array $parameters = [])
    {
        $this->parameters = new ParameterBag();

        $this->initialize($parameters);
    }

    protected function initialize(array $parameters = [])
    {
        Helper::initialize($this, $parameters);

        return $this;
    }

    public function getParameters()
    {
        return $this->parameters->all();
    }

    protected function getParameter($key)
    {
        return $this->parameters->get($key);
    }

    protected function setParameter($key, $value)
    {
        $this->parameters->set($key, $value);

        return $this;
    }

    public function setSerialNumber($value)
    {
        return $this->setParameter('serialNumber', $value);
    }

    public function getSerialNumber()
    {
        return $this->getParameter('serialNumber');
    }

    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
    }

    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }
}
