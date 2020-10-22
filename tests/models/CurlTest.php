<?php
// Different assertions: https://phpunit.readthedocs.io/en/9.3/assertions.html
// @depends: https://phpunit.readthedocs.io/en/9.3/writing-tests-for-phpunit.html#writing-tests-for-phpunit-examples-stacktest2-php

require_once __DIR__ . '/../../models/Curl.php';

class CurlTest extends PHPUnit\Framework\TestCase
{
    public function testCurlExampleDotComRequest()
    {
        $url = 'https://www.example.com';
        $curl = new Curl($url);

        $this->assertStringContainsString('<h1>Example Domain</h1>', $curl->result);
    }

    public function testInvalidUrl()
    {
        $url = 'https://www.this-is-not-a-domain.com';
        $curl = new Curl($url);

        $this->assertEquals('', $curl->result);
    }
}