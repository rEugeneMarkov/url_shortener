<?php

namespace App\Services\UrlService;

use Illuminate\Http\Client\Response;
use App\Services\UrlService\Actions\GetTitleAction;
use App\Services\UrlService\Actions\GetFaviconAction;
use App\Services\UrlService\Actions\GetLinkResponseAction;
use App\Services\UrlService\Actions\CheckResponseStatusAction;

class UrlService
{
    private string $link;

    private ?Response $response = null;

    public function setLink(string $link): UrlService
    {
        $this->link = $link;
        return $this;
    }

    private function getLinkResponse(): Response
    {
        if (is_null($this->response)) {
            $this->response = app(GetLinkResponseAction::class)->run($this->link);
        }

        return $this->response;
    }

    public function checkResponseStatus(): bool
    {
        return (app(CheckResponseStatusAction::class)->run($this->getLinkResponse()));
    }

    public function getLinkTitle(): string
    {
        return (app(GetTitleAction::class)->run($this->getLinkResponse()));
    }

    public function getFavicon(): string
    {
        return (app(GetFaviconAction::class)->run($this->getLinkResponse()));
    }
}
