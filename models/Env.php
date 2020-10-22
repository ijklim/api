<?php
require_once __DIR__ . '/../vendor/autoload.php';

class Env
{
    /**
     * Load environment variables from .env file
     */
    public static function load()
    {
        // Ref: https://github.com/vlucas/phpdotenv
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();
    }

    /**
     * Returns value of an environment variable
     *
     * @param  string $variableName
     * @return mixed
     */
    public static function get($variableName)
    {
        if (!isset($_ENV[$variableName])) {
            return null;
        }

        return $_ENV[$variableName];
    }
}
