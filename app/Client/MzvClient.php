<?php

namespace App\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

final class MzvClient
{
    private Client $client;

    private CookieJar $cookieJar;

    public function __construct(Client $client, CookieJar $cookieJar)
    {
        $this->client = $client;
        $this->cookieJar = $cookieJar;
    }

    public function fetchWithCookies(string $url): string
    {
        // Step 1: Visit homepage to get cookies
        $this->client->get('https://www.mzv.cz', [
            'cookies' => $this->cookieJar
        ]);

        // Step 2: Visit actual target page
        $response = $this->client->get($url, [
            'cookies' => $this->cookieJar
        ]);

        return $response->getBody()->getContents();
    }
}
