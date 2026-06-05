<?php

namespace Tests;

use App\Support\HtmlParser;
use PHPUnit\Framework\TestCase;

final class HtmlParserTest extends TestCase
{
    private HtmlParser $parser;

    protected function setUp(): void
    {
        $this->parser = new HtmlParser();
    }

    public function test_extracts_code_from_valid_html(): void
    {
        $html = $this->buildHtml('G6D1S8G8');

        $result = $this->parser->extractCode($html);

        $this->assertSame('G6D1S8G8', $result);
    }

    public function test_returns_null_when_selector_not_found(): void
    {
        $result = $this->parser->extractCode('<html><body><p>No code here</p></body></html>');

        $this->assertNull($result);
    }

    public function test_strips_non_breaking_spaces_from_code(): void
    {
        $html = $this->buildHtml("G6D1S8G8\xC2\xA0");

        $result = $this->parser->extractCode($html);

        $this->assertSame('G6D1S8G8', $result);
    }

    private function buildHtml(string $code): string
    {
        return <<<HTML
        <html><body>
        <div id="content">
            <article>
                <div class="article_content">
                    <div>
                        <ul><li>first ul</li></ul>
                        <ul>
                            <li>item 1</li>
                            <li>item 2</li>
                            <li>item 3 <strong>a</strong><strong>b</strong><strong>c</strong><strong>{$code}</strong></li>
                        </ul>
                    </div>
                </div>
            </article>
        </div>
        </body></html>
        HTML;
    }
}
