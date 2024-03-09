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
        $lessons = $this->lessonRepository->getMaster();
        $questions = $this->questionRepository->fetchRandom($params);
        $question2rates = $this->questionRepository->getRetation(Arr::pluck($questions, 'question_id') + [0])['question2rates'];

        foreach ($lessons as $lesson) {
            $lessonList[$lesson->lesson_id] = $lesson;
        }

        foreach ($questions as $question) {
            if (! $question->question_correct == 0) {
                $questionCorrectRate[$question->question_id] = number_format($question->question_correct / ($question->question_correct + $question->question_incorrect) * 100, 0);
            }
        }

        foreach ($question2rates as $rate_question_id => $question2rate) {
            if (! $question2rate->rate_correct == 0) {
                $questionUserCorrectRate[$rate_question_id] = number_format($question2rate->rate_correct / ($question2rate->rate_correct + $question2rate->rate_incorrect) * 100, 0);
            }
        }

        $this->fetchQuestionsService['lessons'] = $lessonList;
        $this->fetchQuestionsService['questions'] = $questions;
        $this->fetchQuestionsService['questionCorrectRate'] = $questionCorrectRate;
        $this->fetchQuestionsService['questionUserCorrectRate'] = $questionUserCorrectRate;

        return $this->fetchQuestionsService;
    }
}
