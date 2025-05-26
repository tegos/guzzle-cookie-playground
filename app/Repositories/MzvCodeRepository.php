<?php

namespace App\Repositories;

use App\client\MzvClient;
use App\support\HtmlParser;

final class MzvCodeRepository
{
    private MzvClient $client;

    private HtmlParser $parser;

    public function __construct(MzvClient $client, HtmlParser $parser)
    {
        $this->client = $client;
        $this->parser = $parser;
    }

    public function getVerificationCode(): ?string
    {
        $url = 'https://mzv.gov.cz/lvov/uk/x2004_02_03/x2016_05_18/x2017_11_24_1.html';
        $html = $this->client->fetchWithCookies($url);

        return $this->parser->extractCode($html);
    }
}
