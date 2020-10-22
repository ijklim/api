<?php
// Different assertions: https://phpunit.readthedocs.io/en/9.3/assertions.html
// @depends: https://phpunit.readthedocs.io/en/9.3/writing-tests-for-phpunit.html#writing-tests-for-phpunit-examples-stacktest2-php

require_once __DIR__ . '/../../models/Api.php';

class ApiTest extends PHPUnit\Framework\TestCase
{
    public function testFalseIsReturnedDuringCreationIfKeyTypeIsInvalid()
    {
        $keyType = 'NOT_VALID';
        $fields = [
            'word' => 'progress',
        ];
        $api = Api::create($keyType, $fields);
        $this->assertSame(false, $api);
    }

    public function testCreationOfDictionaryKeyType()
    {
        $keyType = 'dictionary';
        $word = 'progress';
        $fields = [
            'word' => $word,
        ];
        $api = Api::create($keyType, $fields);
        $this->assertInstanceOf(Api::class, $api);

        // Ensure key type is set correctly, also testing the method `__get()` by accessing private attribute `keyType`
        $this->assertSame($keyType, $api->keyType);

        // Ensure Api Key can be retrieved
        $apiKey = $api->getApiKey();
        $this->assertGreaterThan(0, strlen($apiKey));

        // Ensure url is set correctly
        $apiKey = $api->getApiKey();
        $url = "https://www.dictionaryapi.com/api/v3/references/collegiate/json/{$word}?key={$apiKey}";
        $this->assertSame($url, $api->url);
    }

    public function testFalseIsReturnedDuringCreationIfRequiredFieldIsMissing()
    {
        $keyType = 'dictionary';
        $fields = [];
        $api = Api::create($keyType, $fields);
        $this->assertSame(false, $api);

        $fields = [
            'wrong_field' => 'progress',
        ];
        $api = Api::create($keyType, $fields);
        $this->assertSame(false, $api);
    }
}
