<?php

namespace App\Services\UrlService\Actions;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Client\ConnectionException;

class GetLinkResponseAction
{
    public function run(string $url): Response
    {
        try {
            return Http::get($url);
        } catch (ConnectionException $exception) {
            throw ValidationException::withMessages([
                'link' => ['Your link is not valid.'],
            ]);
        }
    }
}
