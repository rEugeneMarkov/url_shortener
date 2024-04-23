<?php

namespace App\Services\UrlService\Actions;

use Illuminate\Http\Client\Response;
use Illuminate\Validation\ValidationException;

class CheckResponseStatusAction
{
    public function run(Response $response): bool
    {
        if ($response->status() !== 200) {
            throw ValidationException::withMessages([
                'link' => ['Status code ' . $response->status()],
            ]);
        }

        return $response->status() === 200;
    }
}
