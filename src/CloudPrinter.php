<?php

namespace Demokn\CloudPrinter;

use Demokn\CloudPrinter\Gateway\GatewayInterface;
use Demokn\CloudPrinter\Http\ClientInterface;

/**
 * @method static GatewayInterface create(string $class, ClientInterface $httpClient = null, \Symfony\Component\HttpFoundation\Request $httpRequest = null)
 */
class CloudPrinter
{
    private static $factory;

    public static function getFactory(): GatewayFactory
    {
        if (is_null(self::$factory)) {
            self::$factory = new GatewayFactory();
        }

        return self::$factory;
    }

    public static function setFactory(GatewayFactory $factory = null): void
    {
        self::$factory = $factory;
    }

    public static function __callStatic($method, $parameters)
    {
        $factory = self::getFactory();

        return call_user_func_array([$factory, $method], $parameters);
    }
}
