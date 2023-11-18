<?php

namespace App\Services\User;

use App\Repositories\Question2RateRepository as RateRepository;
use App\Repositories\QuestionRepository as QuestionRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisterRateService
{
    public $fetchListService;

    public RateRepository $rateRepository;

    public QuestionRepository $questionRepository;

    public function __construct()
    {
        $this->rateRepository = new RateRepository();
        $this->questionRepository = new QuestionRepository();
    }

    public function register($params)
    {
        $params = [
            'question_id' => data_get($params, 'question_id', 0),
            'isCorrect' => data_get($params, 'is_correct', 0),
        ];

        DB::beginTransaction();
        try {
            $this->fetchListService = $this->questionRepository->reflectAnswerResult($params);
            if (Auth::user()) {
                $params['rate_user_id'] = Auth::id();
                $this->fetchListService += $this->rateRepository->reflectAnswerResult($params);
            }
            DB::commit();
        } catch (\Exception $e) {
            Log::error(print_r($e, true));
            DB::rollback();
        }

        return $this->fetchListService;
    }
}
