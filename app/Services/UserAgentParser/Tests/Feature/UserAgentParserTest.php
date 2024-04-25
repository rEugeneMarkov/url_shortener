<?php

namespace App\Services\LocationFinder\Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Services\UserAgentParser\UserAgentParserService;
use Tests\TestCase;

class UserAgentParserTest extends TestCase
{
    public function testUserAgentParserSuccess()
    {
        $userAgent =
            "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) 
            AppleWebKit/537.36 (KHTML, like Gecko) 
            Chrome/124.0.0.0 Safari/537.36";

        $userAgentParser = new UserAgentParserService();
        $data = $userAgentParser
            ->userAgent($userAgent)
            ->getUserAgentData()
            ->toArray();

        $this->assertArrayHasKey('browser', $data);
        $this->assertArrayHasKey('os', $data);
        $this->assertArrayHasKey('device', $data);
        $this->assertEquals('Chrome', $data['browser']);
        $this->assertEquals('Macintosh', $data['os']);
        $this->assertEquals('Desktop', $data['device']);
    }

    public function testUserAgentParserWithoutUserAgent()
    {
        $userAgentParser = new UserAgentParserService();
        $data = $userAgentParser->getUserAgentData()->toArray();

        $this->assertArrayHasKey('browser', $data);
        $this->assertArrayHasKey('os', $data);
        $this->assertArrayHasKey('device', $data);
        $this->assertEquals('Other', $data['browser']);
        $this->assertEquals('Other', $data['os']);
        $this->assertEquals('Other', $data['device']);
    }
}
