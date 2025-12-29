<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OfflineMethod extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'instructions', 'type', 'image', 'offline_method_media_id', 'bank_details', 'status'];

    protected $casts    = [
        'bank_details' => 'array',
        'image'        => 'array',
    ];

    public function offlineMethodMedia(): BelongsTo
    {
        return $this->belongsTo(MediaLibrary::class);
    }

    public function languages(): HasMany
    {
        return $this->hasMany(OfflineMethodLanguage::class);
    }

    public function language(): HasOne
    {
        return $this->hasOne(OfflineMethodLanguage::class)->where('lang', app()->getLocale());
    }

    public function getLangNameAttribute()
    {
        return $this->language ? $this->language->name : $this->name;
    }

    public function getLangInstructionsAttribute()
    {
        return $this->language ? $this->language->instructions : $this->instructions;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
