<?php

namespace App\Services\UserAgentParser;

use App\Services\UserAgentParser\Actions\ParseUserAgentAction;

class UserAgentParserService
{
    private string $userAgent = '';

    public function userAgent(string $userAgent): static
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    public function getUserAgentData()
    {
        return app()->make(ParseUserAgentAction::class)->run($this->userAgent);
    }
}
