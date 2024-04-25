<?php

namespace App\Services\LocationFinder\Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Services\LocationFinder\DTO\GeoDataDTO;
use App\Services\LocationFinder\LocationFinderService;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class LocationFinderTest extends TestCase
{
    public static function ipProvider(): array
    {
        return [
            ['127.0.0.1'],
            ['38.0.101.76'],
            ['38.0'],
        ];
    }
    #[DataProvider('ipProvider')]
    public function testLocationFinderReturnDto(string $ip): void
    {
        $locationFinder = new LocationFinderService();
        $this->assertInstanceOf(GeoDataDTO::class, $locationFinder->getGeoDataByIp($ip));
    }
    public function testLocationFinderWhenSuccess(): void
    {
        $locationFinderMock = $this->createMock(LocationFinderService::class);

        $locationFinderMock->method('getGeoDataByIp')->willReturn(new GeoDataDTO('46.109.92.251', 'Latvia', 'Riga'));

        $data = $locationFinderMock->getGeoDataByIp('46.109.92.251')->toArray();
        $this->assertIsArray($data);
        $this->assertArrayHasKey('city', $data);
        $this->assertArrayHasKey('country', $data);
        $this->assertEquals('Latvia', $data['country']);
        $this->assertEquals('Riga', $data['city']);
    }
    public function testLocationFinderWhenCityIsUndefined(): void
    {
        $locationFinderMock = $this->createMock(LocationFinderService::class);

        $locationFinderMock->method('getGeoDataByIp')
            ->willReturn(new GeoDataDTO('185.225.225.130', 'Finland', 'Undefined'));

        $data = $locationFinderMock->getGeoDataByIp('185.225.225.130')->toArray();
        $this->assertIsArray($data);
        $this->assertArrayHasKey('city', $data);
        $this->assertArrayHasKey('country', $data);
        $this->assertEquals('Finland', $data['country']);
        $this->assertEquals('Undefined', $data['city']);
    }

    public function testLocationFinderWhenWrongIp(): void
    {
        $locationFinderMock = $this->createMock(LocationFinderService::class);

        $locationFinderMock->method('getGeoDataByIp')
            ->willReturn(new GeoDataDTO('Undefined', 'Undefined', 'Undefined'));

        $data = $locationFinderMock->getGeoDataByIp('127.0.')->toArray();
        $this->assertIsArray($data);
        $this->assertArrayHasKey('city', $data);
        $this->assertArrayHasKey('country', $data);
        $this->assertEquals('Undefined', $data['country']);
        $this->assertEquals('Undefined', $data['city']);
    }
}
