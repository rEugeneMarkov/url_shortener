<?php

namespace App\Services\UrlService\Actions;

use DOMNodeList;
use Illuminate\Http\Client\Response;
use App\Services\UrlService\Traits\HasDOMDocument;

class GetFaviconAction
{
    use HasDOMDocument;

    private Response $response;

    public function run(Response $response): string
    {
        $this->response = $response;
        $faviconUrl = $this->extractFaviconUrl();

        return $faviconUrl;
    }

    private function extractFaviconUrl(): string
    {
        $faviconUrl = asset('storage/images/favicon.svg');
        $links = $this->getLinksFromDOMDocument();

        foreach ($links as $link) {
            if (strpos($link->getAttribute('rel'), 'icon') !== false) {
                $faviconUrl = $link->getAttribute('href');
                break;
            }
        }

        return $this->generateFullFaviconUrl($faviconUrl);
    }

    private function getLinksFromDOMDocument(): DOMNodeList
    {
        $dom = $this->getDOMDocument();
        return $dom->getElementsByTagName('link');
    }

    private function generateFullFaviconUrl(string $faviconUrl): string
    {
        if (filter_var($faviconUrl, FILTER_VALIDATE_URL)) {
            return $faviconUrl;
        } else {
            return $this->getBaseUrl() . '/' . ltrim($faviconUrl, '/');
        }
    }

    private function getBaseUrl(): string
    {
        $uri = $this->response->transferStats->getRequest()->getUri();
        $host = $uri->getHost();
        $scheme = $uri->getScheme();
        return rtrim($scheme . '://' . $host, '/');
    }
}
