<?php

require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

return [
    'target_url' => 'https://mzv.gov.cz/lvov/uk/x2004_02_03/x2016_05_18/x2017_11_24_1.html',
    'client' => new Client([
        'cookies' => true,
        'http_errors' => false,
        'headers' => [
            'User-Agent' => 'Mozilla/5.0 (Guzzle Playground)'
        ]
    ]),
    'cookieJar' => new CookieJar(),
];
