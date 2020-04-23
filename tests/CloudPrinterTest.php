<?php

namespace Demokn\CloudPrinter\Tests;

use Demokn\CloudPrinter\CloudPrinter;
use Demokn\CloudPrinter\GatewayFactory;
use Mockery;
use PHPUnit\Framework\TestCase;

class CloudPrinterTest extends TestCase
{
    public function tearDown(): void
    {
        CloudPrinter::setFactory(null);

        parent::tearDown();
    }

    public function testGetFactory()
    {
        CloudPrinter::setFactory(null);

        $factory = CloudPrinter::getFactory();
        $this->assertInstanceOf(GatewayFactory::class, $factory);
    }

    public function testSetFactory()
    {
        $factory = Mockery::mock(GatewayFactory::class);

        CloudPrinter::setFactory($factory);

        $this->assertSame($factory, CloudPrinter::getFactory());
    }

    public function testCallStatic()
    {
        $factory = Mockery::mock(GatewayFactory::class);
        $factory->shouldReceive('testMethod')->with('some-argument')->once()->andReturn('some-result');

        CloudPrinter::setFactory($factory);

        $result = CloudPrinter::testMethod('some-argument');
        $this->assertSame('some-result', $result);
    }
}
