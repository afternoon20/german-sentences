<?php

namespace App\Services\User;

use App\Repositories\LessonRepository;
use App\Repositories\QuestionRepository;

class FetchListService
{
    public $fetchListService;

    public LessonRepository $lessonRepository;

    public QuestionRepository $questionRepository;

    public function __construct()
    {
        $this->lessonRepository = new LessonRepository();
        $this->questionRepository = new QuestionRepository();
    }

    public function findList($params)
    {
        $lessonList = [];
        $questionCorrectRate = [];

        $lessons = $this->lessonRepository->getMaster();
        foreach ($lessons['lessons'] as $lesson) {
            $lessonList[$lesson->lesson_id] = $lesson;
        }

        $this->fetchListService = $this->questionRepository->fetchAll($params);
        foreach ($this->fetchListService['questions'] as $question) {
            if (! $question->question_correct == 0) {
                $questionCorrectRate[$question->question_id] = number_format($question->question_correct / ($question->question_correct + $question->question_incorrect) * 100, 0);
            }
        }

        $this->fetchListService['questionCorrectRate'] = $questionCorrectRate;
        $this->fetchListService += $lessons;

        return $this->fetchListService;
    }
}
