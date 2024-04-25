<?php

namespace App\Services\LocationFinder\DTO;

class GeoDataDTO
{
    public function __construct(
        public readonly string $ip_address,
        public readonly string $country,
        public readonly string $city,
    ) {
    }

    public function toArray(): array
    {
        return [
            'ip_address' => $this->ip_address,
            'country' => $this->country,
            'city' => $this->city,
        ];
    }

    public static function createFromJson(string $json): self
    {
        $data = json_decode($json, true);
        return new self(
            $data['ip_address'] ?? 'Undefined',
            $data['country'] ?? 'Undefined',
            $data['city'] ?? 'Undefined',
        );
    }
}
