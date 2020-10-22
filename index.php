<?php
require_once __DIR__ . '/models/Api.php';
require_once __DIR__ . '/models/Curl.php';

/**
 * Hide api keys from client applications
 *
 * Version: 1.1.6
 * Date: 10/22/2020
 *
 * Usage samples:
 *  • Definition of word 'umpire': https://api.ivan-lim.com?a=dictionary&word=umpire
 *  • Print result as array: https://api.ivan-lim.com?a=dictionary&word=umpire&debug
 */
header("Version: 1.1.6");

$apiKeyType = isset($_GET['a']) && strlen($_GET['a']) ? htmlentities($_GET['a'], ENT_QUOTES, 'UTF-8') : '';

$api = Api::create($apiKeyType, $_GET);

if (!$api) {
    // Ref: https://developer.mozilla.org/en-US/docs/Web/HTTP/Status
    http_response_code(400);
    echo 'Invalid call!';
    exit;
}


$curl = new Curl($api->url);

// Debug mode
if (isset($_GET['debug'])) {
    // Convert json data into an array
    $resultArray = json_decode($curl->result, true);

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

echo $curl->result;
exit;
