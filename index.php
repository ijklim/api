<?php
/**
 * Hide api keys from client applications
 *
 * Version: 1.0.3
 * Date: 5/15/2020
 *
 * Usage samples:
 *  • Definition of word 'umpire': https://api.ivan-lim.com?a=dictionary&word=umpire
 *  • Print result as array: https://api.ivan-lim.com?a=dictionary&word=umpire&debug
 */

// Note: Text within {$...} is intended to be replaced with the query string value of the same name
// Note: {API_KEY} will be replaced by key specified in `.env` file
$apiKeyMappings = [
    'dictionary' => 'https://www.dictionaryapi.com/api/v3/references/collegiate/json/{$word}?key={API_KEY}',
    'thesaurus' => 'https://www.dictionaryapi.com/api/v3/references/thesaurus/json/{$word}?key={API_KEY}',
    '-' => '',
];

$apiKeyType = isset($_REQUEST['a']) && strlen($_REQUEST['a']) ? htmlentities($_REQUEST['a'], ENT_QUOTES, 'UTF-8') : '-';

$url = $apiKeyMappings[$apiKeyType];

if (!strlen($url)) {
    // echo 'Invalid call!';
    exit;
}

// Ref: https://github.com/vlucas/phpdotenv
// Api keys are defined in .env file, format: API_KEY_{key_type}
require_once realpath(__DIR__ . "/vendor/autoload.php");
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$url = str_replace('{API_KEY}', $_ENV['API_KEY_' . strtoupper($apiKeyType)], $url);

foreach ($_GET as $param => $value) {
    $url = str_replace('{$' . $param . '}', htmlentities($value, ENT_QUOTES, 'UTF-8'), $url);
}

if (strpos($url, '{$')) {
    // echo 'Required parameter missing!';
    exit;
}

$ch = curl_init();

// Set the url
curl_setopt($ch, CURLOPT_URL, $url);

// We want to just grab the data
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Ignore SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

// Execute post
$result = curl_exec($ch);

// Close connection
curl_close($ch);

// Debug mode
if (isset($_GET['debug'])) {
    // Convert json data into an array
    $resultArray = json_decode($result, true);

    // Display array
    echo "<pre>";
    var_dump($resultArray);
    echo "</pre>";

    exit;
}

header("Content-Type: application/json; charset=UTF-8");
// Specify which domain can access this page
// Ref: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Origin
header("Access-Control-Allow-Origin: https://wordvault.ivan-lim.com", false);
header("Version: 1.0.1");

echo $result;
exit;
