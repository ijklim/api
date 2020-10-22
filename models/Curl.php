<?php

class Curl
{
    public $result;

    /**
     * Visits a url and assign result to attribute $result
     */
    public function __construct($url)
    {
        $ch = curl_init();

        // Set the url
        curl_setopt($ch, CURLOPT_URL, $url);

        // We want to just grab the data
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Ignore SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        // Execute post
        $this->result = curl_exec($ch);

        // Close connection
        curl_close($ch);
    }
}
