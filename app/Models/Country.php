<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'iso3', 'iso2', 'phonecode', 'currency', 'currency_symbol', 'latitude', 'longitude', 'status'];

    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function flag()
    {
        return $this->hasOne(FlagIcon::class, 'title', 'iso2');
    }

    public function getFlagIconAttribute()
    {
        return $this->flag ? static_asset($this->flag->image) : static_asset('images/default/default-image-40x40.png');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
