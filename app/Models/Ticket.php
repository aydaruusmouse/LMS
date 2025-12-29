<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'subject',
        'department_id',
        'user_id',
        'priority',
        'status',
        'ticket_id',
        'viewed',
        'client_viewed',
        'file',
        'file_media_id',
        'body',
    ];

    protected $casts    = [
        'file' => 'array',
    ];

    public function getNameAttribute(): string
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function department(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function replies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TicketReply::class);
    }

    public function lastReply(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(TicketReply::class)->latest();
    }
}
