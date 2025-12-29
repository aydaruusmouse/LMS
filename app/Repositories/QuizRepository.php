<?php

namespace App\Repositories;

use App\Models\Quiz;

class QuizRepository
{
    public function store($request)
    {
        $request['slug'] = getSlug('quizzes', $request['title']);

        return Quiz::create($request);
    }

    public function find($id)
    {
        return Quiz::find($id);
    }

    public function update($request, $id)
    {
        $quiz            = Quiz::findOrfail($id);
        $request['slug'] = getSlug('quizzes', $request['title']);

        return $quiz->update($request);
    }

    public function destroy($id)
    {
        return Quiz::destroy($id);
    }

    public function findBySlug($slug)
    {
        return Quiz::with('section')->where('slug', $slug)->first();
    }
}
