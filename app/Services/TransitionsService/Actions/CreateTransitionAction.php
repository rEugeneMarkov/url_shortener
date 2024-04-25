<?php

namespace App\Services\TransitionsService\Actions;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Services\TransitionsService\Models\Transition;
use App\Services\TransitionsService\Contracts\Transitionable;

class CreateTransitionAction
{
    private readonly Transitionable $transitionable;

    private readonly array $locationData;

    private readonly array $userAgentData;

    public function transitionable(Transitionable $transitionable): static
    {
        $this->transitionable = $transitionable;
        return $this;
    }

    public function setLocationData(array $locationData): static
    {
        $this->locationData = $locationData;
        return $this;
    }

    public function setUserAgentData(array $userAgentData): static
    {
        $this->userAgentData = $userAgentData;
        return $this;
    }

    public function run(): void
    {
        try {
            Transition::create([
                'transitionable_id' => $this->transitionable->getTransitionableId(),
                'transitionable_type' => $this->transitionable->getTransitionableType(),
                'country' => $this->locationData['country'],
                'city' => $this->locationData['city'],
                'ip_address' => $this->locationData['ip_address'],
                'user_agent' => $this->userAgentData['user_agent'],
                'os' => $this->userAgentData['os'],
                'browser' => $this->userAgentData['browser'],
                'device' => $this->userAgentData['device'],
            ]);
        } catch (Exception $e) {
            Log::warning($e->getMessage());
        }
    }
}
