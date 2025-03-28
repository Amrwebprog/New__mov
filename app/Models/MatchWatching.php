<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchWatching extends Model
{
    /** @use HasFactory<\Database\Factories\MatchWatchingFactory> */
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
    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
    public function matches(): BelongsTo
    {
        return $this->BelongsTo(Matches::class);
    }
}
