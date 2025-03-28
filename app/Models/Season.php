<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Season extends Model
{
    /** @use HasFactory<\Database\Factories\SeasonFactory> */
    use HasFactory, SoftDeletes;
    protected $guarded = [
        'created_at',
        'deleted_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'deleted_at',
        'updated_at',
    ];
    public function series(): BelongsTo
    {
        return $this->belongsTo(Series::class);
    }
    public function episdes(): HasMany
    {
        return $this->hasMany(Episode::class);
    }
}
