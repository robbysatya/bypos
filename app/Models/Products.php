<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Products extends Model
{
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
    public function costumer()
    {
        return $this->belongsTo(Costumers::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
