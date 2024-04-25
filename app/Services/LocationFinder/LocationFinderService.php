<?php

namespace App\Services\LocationFinder;

use App\Services\LocationFinder\Actions\GetGeoDataByIpAction;
use App\Services\LocationFinder\DTO\GeoDataDTO;

class LocationFinderService
{
    public function getGeoDataByIp(string $ip): GeoDataDTO
    {
        return (app()->make(GetGeoDataByIpAction::class))->run($ip);
    }
}
