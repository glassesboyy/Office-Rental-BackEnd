<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class OfficeSpace extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'thumbnail',
        'address',
        'is_booked',
        'is_full_booked',
        'price',
        'duration',
        'about',
        'city_id',
        'slug'
    ];

    protected $casts = [
        'is_booked' => 'boolean',
        'is_full_booked' => 'boolean',
        'price' => 'integer',
        'duration' => 'integer',
    ];

    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = ($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function benefits(): HasMany
    {
        return $this->hasMany(OfficeSpaceBenefit::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(OfficeSpacePhoto::class);
    }

    public function bookingTransactions(): HasMany
    {
        return $this->hasMany(BookingTransaction::class);
    }
}
