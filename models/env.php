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
}
