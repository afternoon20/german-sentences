<?php

namespace App\Repositories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Collection;

class LessonRepository
{
    public function getMaster($select = []) : Collection
    {
        $lessons = Lesson::where($select)->get();

        return $lessons;
    }

    public function fetchAll($params)
    {
        $lessons = Lesson::where(function ($query) use ($params) {
            if (data_get($params, 'lesson_reference_id')) {
                $query->whereIn('lesson_reference_id', data_get($params, 'lesson_reference_id'));
            }
        })->get();

        return compact('lessons');
    }
}
