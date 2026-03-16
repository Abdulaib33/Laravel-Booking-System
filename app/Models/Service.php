<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = ['name', 'price_cents', 'duration_minutes', 'active'];

    protected $casts = ['active' => 'boolean'];


    public function bookings() {
        return $this->hasMany(Booking::class);
    }

}
