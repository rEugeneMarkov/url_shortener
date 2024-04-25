<?php

namespace App\Services\UserAgentParser\DTO;

class UserAgentParserDTO
{
    public function __construct(
        public string $userAgent,
        public string $browser,
        public string $os,
        public string $device,
    ) {
    }

    public function toArray(): array
    {
        return [
            'user_agent' => $this->userAgent,
            'browser' => $this->browser,
            'os' => $this->os,
            'device' => $this->device,
        ];
    }
}
