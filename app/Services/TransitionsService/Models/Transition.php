<?php

namespace App\Services\TransitionsService\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Transition extends Model
{
    use HasFactory;

    protected $fillable = [
        'transitionable_id', 'transitionable_type',
        'country',
        'city',
        'os',
        'browser',
        'device',
        'ip_address',
        'user_agent',
    ];

    public function transitionable(): MorphTo
    {
        return $this->morphTo();
    }
}
