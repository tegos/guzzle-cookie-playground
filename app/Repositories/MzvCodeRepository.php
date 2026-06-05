<?php

namespace App\Repositories;

use App\Client\MzvClient;
use App\Support\HtmlParser;

final class MzvCodeRepository implements CodeRepositoryInterface
{
    private MzvClient $client;

    private HtmlParser $parser;

    private string $url;

    public function __construct(MzvClient $client, HtmlParser $parser, string $url)
    {
        $this->client = $client;
        $this->parser = $parser;
        $this->url = $url;
    }

    public function getVerificationCode(): ?string
    {
        $html = $this->client->fetchWithCookies($this->url);

        return $this->parser->extractCode($html);
    }
}
