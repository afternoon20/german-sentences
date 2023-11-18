<?php

namespace App\Repositories;

use App\Models\Question;
use App\Models\Question2favorite;
use App\Models\Question2rate;
// use App\Models\Question2;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QuestionRepository
{
    public function fetchAll($params)
    {
        $questions = Question::where(function ($query) use ($params) {
            $query->whereIn('question_lesson_id', [data_get($params, 'question_lesson_id', 0)]);
        })->get();

        return compact('questions');
    }

    public function fetchRandom($params)
    {
        $query = Question::inRandomOrder()->where(function ($query) use ($params) {
            $query->whereIn('question_lesson_id', data_get($params, 'lesson_id', [0]));
        })->take(10);
        if (data_get($params, 'is_favorite')) {
            $query->join('question2favorites', 'questions.question_id', '=', 'question2favorites.favorite_question_id')->where('question2favorites.favorite_user_id', Auth::user()->id);
        }
        $questions = $query->get();

        return compact('questions');
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
