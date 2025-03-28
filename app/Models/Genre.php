<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    /** @use HasFactory<\Database\Factories\GenreFactory> */
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
    public function films(): HasMany
    {
        return $this->hasMany(Film::class);
    }
    public function series(): HasMany
    {
        return $this->hasMany(Series::class);
    }
}
