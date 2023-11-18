<?php

namespace App\Repositories;

use App\Models\Question2rate as Rate;

class Question2RateRepository
{
    public function reflectAnswerResult($params)
    {
        $rate = Rate::firstOrNew([
            'rate_question_id' => $params['question_id'],
            'rate_user_id' => $params['rate_user_id'],
        ]);

        if (data_get($params, 'isCorrect')) {
            $rate->rate_correct++;
        } else {
            $rate->rate_incorrect++;
        }
        $rate->save();

        return compact('rate');
    }
}
