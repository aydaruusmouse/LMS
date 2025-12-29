<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    public function store($request)
    {
        return Comment::create($request);
    }
}
