<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmitedAssignment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'assignment_id', 'marks', 'grad', 'file', 'status'];

    protected $casts    = [
        'file' => 'array',
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
