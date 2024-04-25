<?php

namespace App\Services\LocationFinder\Actions;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Services\LocationFinder\DTO\GeoDataDTO;

class GetGeoDataByIpAction
{
    public function run(string $ip): GeoDataDTO
    {
        try {
            $geoData = $this->getGeoData($ip);
        } catch (Exception $exception) {
            Log::warning($exception->getMessage());
            $geoData = new GeoDataDTO('Undefined', 'Undefined', 'Undefined');
        }

        return $geoData;
    }

    public function getGeoData(string $ip): GeoDataDTO
    {
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            return new GeoDataDTO('Undefined', 'Undefined', 'Undefined');
        }

        $geoData = Http::get(env('ABSTRACT_API_URL'), [
            'ip_address' => $ip,
            'api_key' => env('ABSTRACT_API_KEY'),
            'fields' => 'country,city,ip_address',
        ]);

        return GeoDataDTO::createFromJson($geoData->body());
    }
}
