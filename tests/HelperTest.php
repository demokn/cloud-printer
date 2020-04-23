<?php

namespace Demokn\CloudPrinter\Tests;

use Demokn\CloudPrinter\Helper;
use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    public function testCamelCase()
    {
        $this->assertEquals('testCase', Helper::camelCase('testCase'));
        $this->assertEquals('testCase', Helper::camelCase('test_case'));
        $this->assertEquals('testCase', Helper::camelCase('test-case'));
        $this->assertEquals('testCase', Helper::camelCase('test case'));
        $this->assertEquals('tESTCASE', Helper::camelCase('TEST_CASE'));
    }

    public function testStudlyCase()
    {
        $this->assertEquals('TestCase', Helper::studlyCase('testCase'));
        $this->assertEquals('TestCase', Helper::studlyCase('test_case'));
        $this->assertEquals('TestCase', Helper::studlyCase('test-case'));
        $this->assertEquals('TestCase', Helper::studlyCase('test case'));
        $this->assertEquals('TESTCASE', Helper::studlyCase('TEST_CASE'));
    }
}
