<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Services\TransitionsService\Traits\HasTransitions;
use App\Services\TransitionsService\Contracts\Transitionable;

class Link extends Model implements Transitionable
{
    use HasFactory;
    use Filterable;
    use HasTransitions;

    protected $table = 'links';

    protected $fillable = [
        'title',
        'link',
        'back_halve',
        'transitions',
        'favicon',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function booted(): void
    {
        static::creating(function ($model) {
            $model->back_halve = Str::random(5);
            $model->transitions = 0;
            $model->user_id = auth()->user()->id ?? null;
        });
    }
}
