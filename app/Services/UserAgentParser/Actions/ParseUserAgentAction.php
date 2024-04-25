<?php

namespace App\Services\UserAgentParser\Actions;

use App\Services\UserAgentParser\DTO\UserAgentParserDTO;

class ParseUserAgentAction
{
    private readonly string $userAgent;

    public function run($userAgent)
    {
        $this->userAgent = $userAgent;

        $browser = $this->getBrowser();

        $os = $this->getOS();

        $device = $this->getDevice();

        return new UserAgentParserDTO($userAgent, $browser, $os, $device);
    }

    private function getOS(): string
    {
        $osPlatforms = [
            'Windows',
            'Macintosh',
            'Linux',
            'Android',
            'Mac OS',
        ];

        foreach ($osPlatforms as $platform) {
            if (strpos($this->userAgent, $platform) !== false) {
                return $platform;
            }
        }

        return 'Other';
    }

    private function getDevice(): string
    {
        $devices = [
            'Mobile',
            'Tablet',
            'Desktop',
        ];

        foreach ($devices as $device) {
            if (strpos($this->userAgent, $device) !== false) {
                return $device;
            }
        }

        if (strpos($this->userAgent, 'Macintosh') !== false || strpos($this->userAgent, 'Windows') !== false) {
            return 'Desktop';
        }

        return 'Other';
    }

    private function getBrowser(): string
    {
        $browsers = [
            'Edge',
            'Chrome',
            'Firefox',
            'Safari',
            'Opera',
        ];

        foreach ($browsers as $browser) {
            if (strpos($this->userAgent, $browser) !== false) {
                return $browser;
            }
        }

        return 'Other';
    }
}
