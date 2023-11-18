<?php

namespace App\Services\User;

use App\Repositories\LessonRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\ReferenceRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class FetchQuestionsService
{
    public $fetchQuestionsService;

    public QuestionRepository $questionRepository;

    public ReferenceRepository $referenceRepository;

    public LessonRepository $lessonRepository;

    public function __construct()
    {
        $this->questionRepository = new QuestionRepository();
        $this->lessonRepository = new LessonRepository();
        $this->referenceRepository = new ReferenceRepository();
    }

    public function findList($params)
    {
        $lessonList = [];
        $questionCorrectRate = [];
        $questionUserCorrectRate = [];
        //TODO: Vue実装したら削除とサービス層移行
        $lessons = $this->lessonRepository->getMaster();

        foreach ($lessons['lessons'] as $lesson) {
            $lessonList[$lesson->lesson_id] = $lesson;
        }

        $questions = $this->questionRepository->fetchRandom($params);
        foreach ($questions['questions'] as $question) {
            if (! $question->question_correct == 0) {
                $questionCorrectRate[$question->question_id] = number_format($question->question_correct / ($question->question_correct + $question->question_incorrect) * 100, 0);
            }
        }

        $this->fetchQuestionsService = $this->questionRepository->getRetation(Arr::pluck($questions['questions'], 'question_id'));
        foreach ($this->fetchQuestionsService['question2rates'] as $rate_question_id => $question2rate) {
            if (! $question2rate->rate_correct == 0) {
                $questionUserCorrectRate[$rate_question_id] = number_format($question2rate->rate_correct / ($question2rate->rate_correct + $question2rate->rate_incorrect) * 100, 0);
            }
        }

        $this->fetchQuestionsService['params'] = $params;
        $this->fetchQuestionsService['lessons'] = $lessonList;
        $this->fetchQuestionsService += $questions;
        $this->fetchQuestionsService['questionCorrectRate'] = $questionCorrectRate;
        $this->fetchQuestionsService['questionUserCorrectRate'] = $questionUserCorrectRate;

        // dd($this->fetchQuestionsService);

        return $this->fetchQuestionsService;
    }
}
