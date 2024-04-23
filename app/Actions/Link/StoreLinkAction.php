<?php

namespace App\Actions\Link;

use App\Models\Link;
use App\Models\User;
use App\Services\UrlService\UrlService;

class StoreLinkAction
{
    public function __construct(
        private UrlService $urlService
    ) {
    }

    public function run(array $data): Link
    {
        $this->urlService
            ->setLink($data['link'])
            ->checkResponseStatus();

        $data['favicon'] = $this->urlService->getFavicon();

        if ($data['title'] === null) {
            $data['title'] = $this->urlService->getLinkTitle();
        }
        return Link::create($data);
    }
}
