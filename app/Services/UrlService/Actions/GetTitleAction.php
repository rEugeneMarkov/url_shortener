<?php

namespace App\Services\UrlService\Actions;

use DOMNodeList;
use Illuminate\Http\Client\Response;
use App\Services\UrlService\Traits\HasDOMDocument;

class GetTitleAction
{
    use HasDOMDocument;

    private Response $response;

    public function run(Response $response): string
    {
        $this->response = $response;

        return $this->getTitle();
    }

    private function getTitle(): string
    {
        $titleNodes = $this->getTitleNodesFromDOM();

        if ($titleNodes->length > 0) {
            return $titleNodes->item(0)->textContent;
        } else {
            return 'No title found';
        }
    }

    private function getTitleNodesFromDOM(): DOMNodeList
    {
        return $this->getDOMDocument()->getElementsByTagName('title');
    }
}
