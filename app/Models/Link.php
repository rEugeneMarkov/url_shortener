<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Link extends Model
{
    use HasFactory;
    use Filterable;

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
