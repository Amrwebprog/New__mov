<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matches extends Model
{
    /** @use HasFactory<\Database\Factories\MatchesFactory> */
    use HasFactory, SoftDeletes;

    protected  $guarded = [
        'created_at',
        'deleted_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'deleted_at',
        'updated_at',
    ];
    public function match_watchings(): HasMany
    {
        return $this->hasMany(MatchWatching::class);
    }
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}