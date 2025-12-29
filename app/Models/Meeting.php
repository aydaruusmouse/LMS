<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = ['instructor_id', 'invitation_ids', 'start_date', 'end_date', 'meeting_link', 'status'];

    protected $casts    = [
        'invitation_ids' => 'array',
    ];

    public function instructor()
    {
        return $this->hasOne(Instructor::class, 'id');
    }
}
