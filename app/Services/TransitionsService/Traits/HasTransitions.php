<?php

namespace App\Services\TransitionsService\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Services\TransitionsService\Models\Transition;

trait HasTransitions
{
    public function transitions(): MorphMany
    {
        return $this->morphMany(Transition::class, 'transitionable');
    }

    public function getTransitionableId(): int
    {
        return $this->id;
    }

    public function getTransitionableType(): string
    {
        $className = class_basename(self::class);
        return Str::lower($className);
    }
}
