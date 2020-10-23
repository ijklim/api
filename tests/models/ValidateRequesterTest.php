<?php
// Different assertions: https://phpunit.readthedocs.io/en/9.3/assertions.html
// @depends: https://phpunit.readthedocs.io/en/9.3/writing-tests-for-phpunit.html#writing-tests-for-phpunit-examples-stacktest2-php

// Note: The class name being tested is the same as the file name without the 'Test.php' suffix
// e.g. Test script: ApiTest.php, Model script being tested: Api.php
$className = basename(__FILE__, 'Test.php');

require_once __DIR__ . "/../../models/{$className}.php";

class ValidateRequesterTest extends PHPUnit\Framework\TestCase
{
    private $validRequester = 'ivan-lim.com';
    private $invalidRequester = 'example.com';

    public function testListOfValidRequestersAreLoaded()
    {
        $validRequesters = ValidateRequester::getValidRequesters();

        $this->assertIsArray($validRequesters);

        $this->assertContains($this->validRequester, $validRequesters);

        $this->assertNotContains($this->invalidRequester, $validRequesters);
    }

    public function testValidRequester()
    {
        $requestorCheck = ValidateRequester::check($this->validRequester);

        $this->assertSame(true, $requestorCheck);
    }

    public function testInvalidRequester()
    {
        $requestorCheck = ValidateRequester::check($this->invalidRequester);

        $this->assertSame(false, $requestorCheck);
    }
}
