<?php
// Different assertions: https://phpunit.readthedocs.io/en/9.3/assertions.html
// @depends: https://phpunit.readthedocs.io/en/9.3/writing-tests-for-phpunit.html#writing-tests-for-phpunit-examples-stacktest2-php

require_once __DIR__ . '/../../models/Env.php';

class EnvTest extends PHPUnit\Framework\TestCase
{
    public function testEnvironmentVariablesLoadedFromDotEnvFile()
    {
        $noOfEnvironmentVariablesBeforeLoad = count($_ENV);

        Env::load();

        $noOfEnvironmentVariablesAfterLoad = count($_ENV);

        $this->assertGreaterThan($noOfEnvironmentVariablesBeforeLoad, $noOfEnvironmentVariablesAfterLoad);
    }

    public function testGettingDictionaryApiKey()
    {
        $length = strlen(Env::get('API_KEY_DICTIONARY'));

        $this->assertGreaterThan(0, $length);
    }

    public function testNullIsReturnedIfEnvironmentVariableIsNotFound()
    {
        $this->assertEquals(null, Env::get('THIS_IS_NOT_A_KEY'));
    }
}