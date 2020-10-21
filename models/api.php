<?php
require_once __DIR__ . '/env.php';

class Api
{
    // List of valid key types
    // Note: Text within {$...} is intended to be replaced with the query string value of the same name
    // Note: {API_KEY} will be replaced by key specified in `.env` file
    const KEY_TYPES = [
        'dictionary' => 'https://www.dictionaryapi.com/api/v3/references/collegiate/json/{$word}?key={API_KEY}',
        'thesaurus' => 'https://www.dictionaryapi.com/api/v3/references/thesaurus/json/{$word}?key={API_KEY}',
        '-' => '',
    ];

    private $keyType = null;
    private $url = null;

    public function __construct($keyType)
    {
        // Only valid keyType will be assigned
        if (!isset(self::KEY_TYPES[$keyType])) {
            return false;
        }

        // Set $keyType
        $this->keyType = $keyType;

        // Set $url
        $this->url = $this->getFormattedUrl($keyType, $_GET);
    }

    /**
     * Give access to private attributes
     */
    public function __get($attribute)
    {
        return $this->$attribute;
    }

    /**
     * Default function to create an Api instance
     */
    public static function create($keyType)
    {
        $api = new self($keyType);

        return $api;
    }

    /**
     * Get url with correct api key and necessary query string values
     *
     * @param  string $keyType
     * @param  array  $fields
     * @return string
     */
    private function getFormattedUrl($keyType, $fields)
    {
        $url = self::KEY_TYPES[$keyType];

        // Api keys are defined in .env file, format: API_KEY_{$keyType}
        Env::load();
        $url = str_replace('{API_KEY}', $_ENV['API_KEY_' . strtoupper($keyType)], $url);

        // Insert query string values
        foreach ($fields as $param => $value) {
            $url = str_replace('{$' . $param . '}', htmlentities($value, ENT_QUOTES, 'UTF-8'), $url);
        }

        if (strpos($url, '{$')) {
            // echo 'Required parameter missing!';
            return '';
        }

        return $url;
    }
}
