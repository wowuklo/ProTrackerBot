<?php

namespace App\Utils;

class HttpClient {

    public function get(string $url) : string
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://dota2protracker.com/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3');

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;

    }
}


