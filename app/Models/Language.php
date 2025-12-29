<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'locale', 'flag', 'text_direction', 'status'];

    public function languageConfig(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(LanguageConfig::class);
    }

    public function flag()
    {
        return $this->hasOne(FlagIcon::class, 'title', 'locale');
    }

    public function getFlagIconAttribute()
    {
        return $this->flag ? static_asset($this->flag->image) : static_asset('images/flags/ad.png');
    }
}
