<?php
require_once __DIR__ . '/Env.php';

class ValidateRequester
{
    /**
     * Get an array of valid requesters
     * Note: Valid requesters should be comma seperated list defined in `.env`, key: VALID_REQUESTERS
     *
     * @return array
     */
    public static function getValidRequesters()
    {
        $environmentVariableName = 'VALID_REQUESTERS';
        $validRequesters = Env::get($environmentVariableName);
        if (!$validRequesters) {
            Env::load();
            $validRequesters = Env::get($environmentVariableName);
        }

        return $validRequesters ? explode(',', $validRequesters) : [];
    }

    public static function check($requester)
    {
        return in_array($requester, self::getValidRequesters());
    }
}