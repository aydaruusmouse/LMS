<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogCommentReply extends Model
{
    use HasFactory;

    protected $fillable = ['reply', 'user_id', 'blog_id', 'blog_comment_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo(BlogComment::class, 'blog_comment_id');
    }
}
