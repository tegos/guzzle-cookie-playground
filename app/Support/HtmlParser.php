<?php

namespace App\Support;

use Symfony\Component\DomCrawler\Crawler;

final class HtmlParser
{
    public function extractCode(string $html): ?string
    {
        $crawler = new Crawler($html);

        $selector = '#content > article > div.article_content > div > ul:nth-child(2) > li:nth-child(3) > strong:nth-child(4)';
        $element = $crawler->filter($selector);

        $code = null;

        if ($element->count()) {
            $code = $this->cleanText($element->text());
        }

        return $code;
    }

    private function cleanText(string $text): string
    {
        $text = preg_replace('/\x{00A0}/u', ' ', $text);
        $text = preg_replace('/[[:space:]]+/', ' ', $text);

        return trim($text);
    }
}
