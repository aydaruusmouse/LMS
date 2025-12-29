<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'package_solutions_id', 'price', 'validity', 'upload_limit', 'add_limit', 'bundle', 'facilities'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subscribe(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PackageSolution::class, 'package_solutions_id');
    }
}
