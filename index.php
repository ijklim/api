<?php
require_once __DIR__ . '/models/api.php';

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

$apiKeyType = isset($_REQUEST['a']) && strlen($_REQUEST['a']) ? htmlentities($_REQUEST['a'], ENT_QUOTES, 'UTF-8') : '-';

$api = Api::create($apiKeyType);

if (!strlen($api->url)) {
    // echo 'Invalid call!';
    exit;
}

$ch = curl_init();

// Set the url
curl_setopt($ch, CURLOPT_URL, $api->url);

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
header("Version: 1.1.0");

echo $result;
exit;
