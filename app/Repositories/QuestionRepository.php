<?php

namespace App\Repositories;

use App\Models\Question;
use App\Models\Question2favorite;
use App\Models\Question2rate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class QuestionRepository
{
    public function fetchAll($params) : array
    {
        $questions = Question::whereIn('question_lesson_id', [data_get($params, 'question_lesson_id', 0)])->get();

        return $$questions;
    }

    public function fetchRandom(array $params, int $limit = 10) : Collection
    {
        $query = Question::whereIn('question_lesson_id', data_get($params, 'lesson_id', [0]));
        if (data_get($params, 'is_favorite')) {
            $query->join('question2favorites', 'questions.question_id', '=', 'question2favorites.favorite_question_id')->where('question2favorites.favorite_user_id', Auth::user()->id);
        }
        $questions = $query->inRandomOrder()->take($limit)->get();

        return $questions;
    }

    public function reflectAnswerResult($params)
    {
        $question = Question::findOrFail(data_get($params, 'question_id'));
        if ((int) data_get($params, 'isCorrect')) {
            $question->question_correct++;
        } else {
            $question->question_incorrect++;
        }
        $question->save();

        return compact('question');
    }

    public function getRetation($id)
    {
        $question2favorites = [];
        $question2rates = [];

        $tmpQuestion2favorites = Question2favorite::where(function ($query) use ($id) {
            $query->whereIn('favorite_question_id', $id + [0]);
            $query->where('favorite_user_id', Auth::user()->id ?? 0);
        })->get();

        foreach ($tmpQuestion2favorites as $tmpQuestion2favorite) {
            $question2favorites[$tmpQuestion2favorite->favorite_question_id] = $tmpQuestion2favorite;
        }

        $tmpQuestion2rates = Question2rate::where(function ($query) use ($id) {
            $query->whereIn('rate_question_id', $id + [0]);
            $query->where('rate_user_id', Auth::user()->id ?? 0);
        })->get();

        foreach ($tmpQuestion2rates as $tmpQuestion2rate) {
            $question2rates[$tmpQuestion2rate->rate_question_id] = $tmpQuestion2rate;
        }

        return compact('question2favorites', 'question2rates');
    }
}
