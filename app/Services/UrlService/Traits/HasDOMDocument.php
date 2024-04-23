<?php

namespace App\Services\UrlService\Traits;

use DOMDocument;

trait HasDOMDocument
{
    protected function getDOMDocument(): DOMDocument
    {
        $dom = new DOMDocument();
        @$dom->loadHTML($this->getHtml());
        return $dom;
    }

    protected function getHtml(): string
    {
        return $this->response->body();
    }
}
