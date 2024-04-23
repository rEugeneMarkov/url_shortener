<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Services\UrlService\UrlService;
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Validation\ValidationException;

class UrlServiceTest extends TestCase
{
    private UrlService $urlService;
    protected function setUp(): void
    {
        parent::setUp();

        $this->urlService = new UrlService();
    }

    protected function createMockedResponse(string $content = '', int $status = 200): void
    {
        HTTP::fake([
            '*' => Http::response($content, $status),
        ]);
    }

    public function testGetLinkTitle()
    {
        $content = '<title>Test Title</title>';

        $this->createMockedResponse($content);

        $title = $this->urlService->setLink('http://example.com')->getLinkTitle();
        $this->assertEquals('Test Title', $title);
    }

    public function testGetLinkTitleFail()
    {
        $content = 'hello world';

        $this->createMockedResponse($content);

        $title = $this->urlService->setLink('http://example.com')->getLinkTitle();
        $this->assertEquals('No title found', $title);
    }

    public function testGetFavicon()
    {
        $content = '<link rel="icon" href="http://example.com/favicon.ico">';

        $this->createMockedResponse($content);

        $favicon = $this->urlService->setLink('http://example.com')->getFavicon();
        $this->assertEquals('http://example.com/favicon.ico', $favicon);
    }

    public function testGetFaviconFail()
    {
        $content = 'hello world';

        $this->createMockedResponse($content);

        $favicon = $this->urlService->setLink('http://example.com')->getFavicon();
        $this->assertEquals('http://localhost/storage/images/favicon.svg', $favicon);
    }

    public function testCheckResponseStatus()
    {
        $content = '<title>Test Title</title>';

        $this->createMockedResponse($content);

        $status = $this->urlService->setLink('http://example.com')->checkResponseStatus();
        $this->assertTrue($status);
    }

    public function testCheckResponseStatusFail()
    {
        Exceptions::fake();

        $content = 'hello world';

        $this->createMockedResponse($content, 404);

        $this->assertThrows(
            fn () => $this->urlService->setLink('http://example.com')->checkResponseStatus(),
            ValidationException::class,
        );
    }
}
