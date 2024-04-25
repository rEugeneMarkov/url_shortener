<?php

namespace App\Services\TransitionsService\Contracts;

interface Transitionable
{
    public function getTransitionableType(): string;

    public function getTransitionableId(): int;
}
