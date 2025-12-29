<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timezone extends Model
{
    use HasFactory;

    protected $fillable = ['country_code', 'timzezone', 'gmt_offset', 'dst_offset', 'raw_offset'];
}
