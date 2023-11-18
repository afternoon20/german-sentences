<?php

namespace App\Services\User;

use App\Repositories\LessonRepository;
use App\Repositories\ReferenceRepository;
use Illuminate\Support\Arr;


class FetchLessonsService
{
    public $fetchLessonsService;
    public LessonRepository $lessonRepository;
    public ReferenceRepository $referenceRepository;

    public function __construct()
    {
        $this->lessonRepository = new LessonRepository();
        $this->referenceRepository = new ReferenceRepository();
        
    }

    public function findList($params)
    {
        $params['reference_id'] = [1];
        $references = $this->referenceRepository->fetchAll($params);
        $this->fetchLessonsService = $this->lessonRepository->fetchAll(['reference_id' => Arr::pluck($references['references'], 'reference_id')]);
        
        return $this->fetchLessonsService;
    }
}