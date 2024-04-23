<?php

namespace App\Actions\Link;

use App\Models\Link;
use App\Models\User;
use App\Services\UrlService\UrlService;

class UpdateLinkAction
{
    public function run(Link $link, array $data): bool
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user->cannot('update', $link)) {
            abort(403);
        }

        return $link->update($data);
    }
}
