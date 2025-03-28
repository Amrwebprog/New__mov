<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class SubscriptionDetails extends Model
{
    /** @use HasFactory<\Database\Factories\SubscriptionDetailsFactory> */
    use HasFactory, SoftDeletes, HasApiTokens;
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
        return $this->belongsTo(User::class);
    }
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}
