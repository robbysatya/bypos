<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Costumers extends Model
{
    public function products(): HasMany
    {
        return $this->hasMany(Products::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function categories(): HasMany
    {
        return $this->hasMany(Categories::class);
    }
}
