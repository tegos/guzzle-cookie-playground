<?php

require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

return [
    'client' => new Client([
        'cookies' => true,
        'http_errors' => false,
        'headers' => [
            'User-Agent' => 'Mozilla/5.0 (Guzzle Playground)'
        ]
    ]),
    'cookieJar' => new CookieJar()
];
